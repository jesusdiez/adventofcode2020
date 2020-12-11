<?php
declare(strict_types=1);

namespace AoC20\Day9;

use AoC20\Tools\Day;

final class Day9 implements Day
{
    private array $data;

    public function __construct(string $inputContent)
    {
        $this->data = self::parseInput($inputContent);
    }

    public static function parseInput(string $contents): array
    {
        return explode(PHP_EOL, $contents);
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
