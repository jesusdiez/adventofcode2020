<?php
declare(strict_types=1);

namespace AoC20\Day4;

use AoC20\Tools\File;

final class Day4
{
    private static array $rules = [
        'byr' => ['mandatory' => true, 'pattern' => '/^19[2-9]\d|200[0-2]$/'],
        'iyr' => ['mandatory' => true, 'pattern' => '/^201\d|2020$/'],
        'eyr' => ['mandatory' => true, 'pattern' => '/^202\d|2030$/'],
        'hgt' => ['mandatory' => true, 'pattern' => '/^((1[5-8]\d|19[0-3])cm)|((59|6\d|7[0-6])in)$/'],
        'hcl' => ['mandatory' => true, 'pattern' => '/^\#[0-9a-f]{6}$/'],
        'ecl' => ['mandatory' => true, 'pattern' => '/^(amb|blu|brn|gry|grn|hzl|oth)$/'],
        'pid' => ['mandatory' => true, 'pattern' => '/^([0-9]{9})$/'],
        'cid' => [],
    ];
    private array $passports;

    public function __construct(string $inputContent)
    {
        $this->passports = self::parseInput($inputContent);
    }

    public function part1(): int
    {
        return count(array_filter($this->passports, self::validatePassportPart1Func()));
    }

    public function part2(): int
    {
        return count(array_filter($this->passports, self::validatePassportPart2Func()));
    }

    private static function validatePassportPart1Func(): callable
    {
//        echo "\n keys " . json_encode(array_keys(self::$keys), \JSON_PRETTY_PRINT);
//        echo "\n mandatory keys " . json_encode(self::mandatoryKeys(), \JSON_PRETTY_PRINT);

        return function ($passport) {
//            echo "\n\n-----------------------------------";
//            echo "\n passport " . json_encode($passport, \JSON_PRETTY_PRINT);
//            $validMissing = array_diff(array_keys(self::$keys), array_keys($passport));
            $validExtra = array_diff(array_keys($passport), array_keys(self::$rules));
//            echo "\n valid missing: " . json_encode($validMissing);
//            echo "\n valid extra: " . json_encode($validExtra);
            if (!empty($validExtra)) {
                return false;
            }
            $mandatoryMissing = array_diff(self::mandatoryKeys(), array_keys($passport));
//            $mandatoryExtra = array_diff(array_keys($passport), self::mandatoryKeys());
//            echo "\n mandatory missing: " . json_encode($mandatoryMissing);
//            echo "\n mandatory extra: " . json_encode($mandatoryExtra);
            if (!empty($mandatoryMissing)) {
                return false;
            }

            return true;
        };
    }

    private static function validatePassportPart2Func(): callable
    {
        return function ($passport) {
            $validExtra = array_diff(array_keys($passport), array_keys(self::$rules));
            if (!empty($validExtra)) {
                return false;
            }

            $mandatoryMissing = array_diff(self::mandatoryKeys(), array_keys($passport));
            if (!empty($mandatoryMissing)) {
                return false;
            }

            foreach ($passport as $k => $v) {
                if (!key_exists('pattern', self::$rules[$k])) {
                    continue;
                }
                if (!$match = preg_match(self::$rules[$k]['pattern'], $v)) {
                    return false;
                }
            }

            return true;
        };
    }

    private static function parseInput(string $contents): array
    {
        return array_map(
            fn($kv) => array_reduce(
                preg_split('/\s/', $kv, -1, PREG_SPLIT_NO_EMPTY),
                function($carry, $kv) {
                    [$k, $v] = explode(':', $kv);

                    return array_merge($carry, [$k => $v]);
                },
                []
            ),
            explode(PHP_EOL . PHP_EOL, $contents)
        );
    }

    private static function mandatoryKeys(): array
    {
        return array_filter(array_keys(self::$rules), fn($k) => self::$rules[$k]['mandatory'] ?? false);
    }
}
