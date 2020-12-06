<?php
declare(strict_types=1);

namespace AoC20\Day6;

use AoC20\Tools\Day;

final class Day6 implements Day
{
    private array $groups;

    public function __construct(string $inputContent)
    {
        $this->groups = self::parseInput($inputContent);
    }

    public static function parseInput(string $contents): array
    {
        return explode(PHP_EOL . PHP_EOL, $contents);
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
