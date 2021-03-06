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
        'byr' => '/^19[2-9][0-9]|200[0-2]$/',
        'iyr' => '/^201[0-9]|2020$/',
        'eyr' => '/^202[0-9]|2030$/',
        'hgt' => '/^((1[5-8][0-9]|19[0-3])cm)|((59|6[0-9]|7[0-6])in)$/',
        'hcl' => '/^#[0-9a-f]{6}$/',
        'ecl' => '/^(amb|blu|brn|gry|grn|hzl|oth)$/',
        'pid' => '/^([0-9]{9})$/',
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
//        echo "\n ➡️ Is $v a valid $k?";
        if (!\key_exists($k, self::$rules)) {
            return true;
        }
        $function = 'validate'.\ucfirst($k);
        if(!self::$function($v)) {
//            echo "\n❌ Not valid!";

            return false;
        }

        return true;
    }

    private static function validateByr(string $value): bool
    {
        $value = (int) $value;

        return $value >= 1920 && $value <= 2002;
    }

    private static function validateIyr(string $value): bool
    {
        $value = (int) $value;

        return $value >= 2010 && $value <= 2020;
    }

    private static function validateEyr(string $value): bool
    {
        $value = (int) $value;

        return $value >= 2020 && $value <= 2030;
    }

    private static function validateHgt(string $value): bool
    {
        $measure = \substr($value, -2, 2);
        $size = (int) \substr($value, 0, strlen($value)-2);
        if ($measure == 'in') {
            return $size >= 59 && $size <= 76;
        }
        if ($measure == 'cm') {
            return $size >= 150 && $size <= 193;
        }

        return false;
    }

    private static function validateHcl(string $value): bool
    {
        return (bool) \preg_match('/^#[0-9a-f]{6}$/', $value);
    }

    private static function validateEcl(string $value): bool
    {
        return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
    }

    private static function validatePid(string $value): bool
    {
        return (bool) \preg_match('/^([0-9]{9})$/', $value);
    }

    private static function validatePassportPart1Func(): callable
    {
//        echo "\n keys " . json_encode(array_keys(self::$keys), \JSON_PRETTY_PRINT);
//        echo "\n mandatory keys " . json_encode(self::mandatoryKeys(), \JSON_PRETTY_PRINT);

        return function ($passport) {
            $mandatoryMissing = array_diff(array_keys(self::$rules), array_keys($passport));
            if (!empty($mandatoryMissing)) {
//                echo "\n❌ mandatory missing: " . json_encode($mandatoryMissing);

                return false;
            }

            return true;
        };
    }

    private static function validatePassportPart2Func(): callable
    {
        return function ($passport) {
//            echo "\n\n" . json_encode($passport);
            if (!self::validatePassportPart1Func()($passport)) {
                return false;
            };

            foreach ($passport as $k => $v) {
                if (!self::validateField($k, $v)) {
                    return false;
                }
            }
//            echo "\n✅ ";

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
        return count(array_filter($this->passports, self::validatePassportPart2Func()));
    }
}
