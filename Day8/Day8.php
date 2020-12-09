<?php
declare(strict_types=1);

namespace AoC20\Day8;

use AoC20\Tools\Day;

final class Day8 implements Day
{
    private array $data;

    public function __construct(string $inputContent)
    {
        $this->data = self::parseInput($inputContent);
    }

    public static function parseLine(string $line): array
    {
        return explode(' ', $line);
    }

    public static function parseInput(string $contents): array
    {
        return array_map(
            fn(string $line) => self::parseLine($line),
            array_filter(explode(PHP_EOL, $contents))
        );
    }

    public function part1(): int
    {
        return -1;
    }

    public function part2(): int
    {
        return -1;
    }
}
