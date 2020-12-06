<?php
declare(strict_types=1);

namespace AoC20\Day4;

use AoC20\Tools\Day;

final class Day4 implements Day
{
    private static array $keys = [
        'byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'
    ];

    private static array $rules = [
        'byr' => ['mandatory' => true, 'pattern' => '/^19[2-9]\d|200[0-2]$/'],
        'iyr' => ['mandatory' => true, 'pattern' => '/^201\d|2020$/'],
        'eyr' => ['mandatory' => true, 'pattern' => '/^202\d|2030$/'],
        'hgt' => ['mandatory' => true, 'pattern' => '/^((1[5-8][0-9]|19[0-3])cm)|((59|6[0-9]|7[0-6])in)$/'],
        'hcl' => ['mandatory' => true, 'pattern' => '/^#[0-9a-f]{6}$/'],
        'ecl' => ['mandatory' => true, 'pattern' => '/^(amb|blu|brn|gry|grn|hzl|oth)$/'],
        'pid' => ['mandatory' => true, 'pattern' => '/^([0-9]{9})$/'],
        'cid' => [],
    ];
    private array $passports;

    public function __construct(string $inputContent)
    {
        $this->passports = self::parseInput($inputContent);
    }

    public static function parseInput(string $contents): array
    {
        return array_map(
            function ($kv) {
                ksort($kv);

                return $kv;
            },
            array_map(
                fn($kv) => array_reduce(
                    preg_split('/\s/', $kv, -1, PREG_SPLIT_NO_EMPTY),
                    function ($carry, $kv) {
                        [$k, $v] = explode(':', $kv);

                        return array_merge($carry, [$k => $v]);
                    },
                    []
                ),
                explode(PHP_EOL . PHP_EOL, $contents)
            )
        );
    }

    public static function validateField(string $k, string $v)
    {
        echo "\n ➡️ Validate $k with $v ";
        if (!key_exists('pattern', self::$rules[$k])) {
            echo "(OK, no mandatory)";

            return true;
        }
        if (!$match = preg_match(self::$rules[$k]['pattern'], $v)) {
            echo "\n❌  Match failure!";

            return false;
        }

        return true;
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
            if (!empty($validExtra)) {
                echo "\n❌ valid extra: " . json_encode($validExtra);

                return false;
            }
            $mandatoryMissing = array_diff(self::mandatoryKeys(), array_keys($passport));
//            $mandatoryExtra = array_diff(array_keys($passport), self::mandatoryKeys());
//            echo "\n mandatory extra: " . json_encode($mandatoryExtra);
            if (!empty($mandatoryMissing)) {
                echo "\n❌ mandatory missing: " . json_encode($mandatoryMissing);

                return false;
            }

            return true;
        };
    }

    private static function validatePassportPart2Func(): callable
    {
        return function ($passport) {
            echo "\n" . json_encode($passport);
            if (!self::validatePassportPart1Func()($passport)) {
                echo "\n❌ failed on first step. ";

                return false;
            };

            foreach ($passport as $k => $v) {
                if (!self::validateField($k, $v)) {
                    return false;
                }
            }

            echo "\n✅ ";

            return true;
        };
    }

    private static function mandatoryKeys(): array
    {
        return array_filter(array_keys(self::$rules), fn($k) => self::$rules[$k]['mandatory'] ?? false);
    }

    public function part1(): int
    {
        return count(array_filter($this->passports, self::validatePassportPart1Func()));
    }

    public function part2(): int
    {
        $valid = array_filter($this->passports, self::validatePassportPart2Func());
        echo "\n\n\n" . json_encode($valid, \JSON_PRETTY_PRINT);

        return count($valid);
    }
}
