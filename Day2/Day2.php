<?php
declare(strict_types=1);

namespace AoC\Day1;

final class Day2
{
    public static function main(): void
    {
        $lines = file(__DIR__ . '/input');
        $rules = array_map(fn($line) => self::match('/(\d+)-(\d+) ([a-z]): (\w+)/', $line), $lines);
        $valid = 0;
        foreach ($rules as [$_, $min, $max, $letter, $password]) {
            $letterMap = \array_count_values(\str_split($password));
            if (key_exists($letter, $letterMap) && $letterMap[$letter] >= $min && $letterMap[$letter] <= $max) {
                $valid++;
            }
        }

        echo "Valid: " . $valid;
    }

    private static function match(string $pattern, string $haystack): array
    {
        preg_match($pattern, $haystack, $matches);

        return $matches;
    }
}

Day2::main();
