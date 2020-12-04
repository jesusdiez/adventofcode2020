<?php
declare(strict_types=1);

namespace AoC20\Day2;

final class Day2
{
    public static function main1(): void
    {
        $valid = 0;
        foreach (self::parseInput() as [$_, $min, $max, $letter, $password]) {
            $letterMap = \array_count_values(\str_split($password));
            if (key_exists($letter, $letterMap) && $letterMap[$letter] >= $min && $letterMap[$letter] <= $max) {
                $valid++;
            }
        }

        echo "Part1 Valid: " . $valid . PHP_EOL;
    }

    public static function main2(): void
    {
        $valid = 0;
        foreach (self::parseInput() as [$_, $pos1, $pos2, $letter, $password]) {
            if ((($password[$pos1 - 1] === $letter ? 1 : 0) + ($password[$pos2 - 1] === $letter ? 1 : 0 )) == 1) {
                $valid++;
            }
        }

        echo "Part2 Valid: " . $valid . PHP_EOL;
    }

    protected static function parseInput(): array
    {
        $lines = file(__DIR__ . '/input');

        return array_map(fn($line) => self::match('/(\d+)-(\d+) ([a-z]): (\w+)/', $line), $lines);
    }

    private static function match(string $pattern, string $haystack): array
    {
        preg_match($pattern, $haystack, $matches);

        return $matches;
    }
}

Day2::main1();
Day2::main2();
