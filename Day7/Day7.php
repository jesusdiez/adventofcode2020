<?php
declare(strict_types=1);

namespace AoC20\Day7;

use AoC20\Tools\Day;

final class Day7 implements Day
{
    private array $data;

    public function __construct(string $inputContent)
    {
        $this->data = self::parseInput($inputContent);
    }

    public static function parseInput(string $contents): array
    {
        return [];
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
