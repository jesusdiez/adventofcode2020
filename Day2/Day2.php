<?php
declare(strict_types=1);

namespace AoC20\Day2;

use AoC20\Tools\Day;

final class Day2 implements Day
{
    private array $lines;

    public function __construct(string $inputContent)
    {
        $this->lines = self::parseInput($inputContent);
    }

    public static function parseInput(string $content): array
    {
        return array_map(
            fn($line) => self::match('/(\d+)-(\d+) ([a-z]): (\w+)/', $line),
            array_filter(explode(PHP_EOL, $content))
        );
    }

    private static function match(string $pattern, string $haystack): array
    {
        preg_match($pattern, $haystack, $matches);

        return $matches;
    }

    public function part1(): int
    {
        $valid = 0;
        foreach ($this->lines as [$_, $min, $max, $letter, $password]) {
            $letterMap = \array_count_values(\str_split($password));
            if (key_exists($letter, $letterMap) && $letterMap[$letter] >= $min && $letterMap[$letter] <= $max) {
                $valid++;
            }
        }

        return $valid;
    }

    public function part2(): int
    {
        $valid = 0;
        foreach ($this->lines as [$_, $pos1, $pos2, $letter, $password]) {
            if ((($password[$pos1 - 1] === $letter ? 1 : 0) + ($password[$pos2 - 1] === $letter ? 1 : 0)) == 1) {
                $valid++;
            }
        }

        return $valid;
    }
}
