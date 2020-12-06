<?php
declare(strict_types=1);

namespace AoC20\Day5;

use AoC20\Tools\Day;

final class Day5 implements Day
{
    private array $boardingPasses;

    public function __construct(string $inputContent)
    {
        $this->boardingPasses = self::parseInput($inputContent);
    }

    public function decode(string $pass): array
    {
        $rows = str_replace(['F','B'], [0, 1], substr($pass, 0, 7));
        $cols = str_replace(['L','R'], [0, 1], substr($pass, 7, 3));

        return [bindec($rows), bindec($cols)];
    }

    public static function parseInput(string $contents): array
    {
        return explode(PHP_EOL, $contents);
    }

    public function part1(): int
    {
        return max(array_map(fn($v) => $this->decode($v)[0] * 8 + $this->decode($v)[1], $this->boardingPasses));
    }

    public function part2(): int
    {
    }
}
