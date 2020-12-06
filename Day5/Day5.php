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

    public static function parseInput(string $contents): array
    {
        return explode(PHP_EOL, $contents);
    }

    public function part1(): int
    {
    }

    public function part2(): int
    {
    }
}
