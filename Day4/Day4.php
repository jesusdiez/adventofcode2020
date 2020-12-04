<?php
declare(strict_types=1);

namespace AoC\Day4;

final class Day4
{
    private static array $keys = [
        'byr' => ['mandatory' => true],
        'iyr' => ['mandatory' => true],
        'eyr' => ['mandatory' => true],
        'hgt' => ['mandatory' => true],
        'hcl' => ['mandatory' => true],
        'ecl' => ['mandatory' => true],
        'pid' => ['mandatory' => true],
        'cid' => [],
    ];
    private array $passports;

    public function __construct(string $inputPath)
    {
        $this->passports = self::parseInput($inputPath);
    }

    public function part1(): int
    {
        return count(array_filter($this->passports, $this->validatePassportFunc()));
    }

    public function main2(): void
    {
    }

    private static function parseInput(string $filePath): array
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
            explode(PHP_EOL . PHP_EOL, file_get_contents($filePath))
        );
    }

    private static function mandatoryKeys(): array
    {
        return array_filter(array_keys(self::$keys), fn($k) => self::$keys[$k]['mandatory'] ?? false == true);
    }

    private function validatePassportFunc(): callable
    {
//        echo "\n keys " . json_encode(array_keys(self::$keys), \JSON_PRETTY_PRINT);
//        echo "\n mandatory keys " . json_encode(self::mandatoryKeys(), \JSON_PRETTY_PRINT);

        return function ($passport) {
//            echo "\n\n-----------------------------------";
//            echo "\n passport " . json_encode($passport, \JSON_PRETTY_PRINT);
//            $validMissing = array_diff(array_keys(self::$keys), array_keys($passport));
            $validExtra = array_diff(array_keys($passport), array_keys(self::$keys));
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
}

print(\str_pad('', 40, "\n"));
printf("Part 1.\n");
printf("Valid passwords: %d\n", (new Day4(__DIR__ . '/sample'))->part1());
//Day4::main2();
