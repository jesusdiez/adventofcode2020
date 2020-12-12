<?php
declare(strict_types=1);

namespace AoC20\Day10;

use AoC20\Tools\Day;

final class Day10 implements Day
{
    private array $data;

    public function __construct(string $inputContent)
    {
        $this->data = self::parseInput($inputContent);
    }

    public static function parseInput(string $contents): array
    {
        return array_map(fn($i) => (int) $i, array_filter(explode(PHP_EOL, $contents)));
    }

    public function part1(): int
    {
        return $this->calculate($this->data);
    }

    public function calculate(array $data): int
    {
        return -1;
    }

    public function part2(): int
    {
        return -1;
    }
}
