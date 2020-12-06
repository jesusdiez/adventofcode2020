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

    public function decode(string $pass): array
    {
        $rows = str_replace(['F', 'B'], [0, 1], substr($pass, 0, 7));
        $cols = str_replace(['L', 'R'], [0, 1], substr($pass, 7, 3));

        return [bindec($rows), bindec($cols)];
    }

    public function calculateSeatId(string $boardingPass): int
    {
        [$row, $col] = $this->decode($boardingPass);

        return $row * 8 + $col;
    }

    public function calculateSeatIds(): array
    {
        return array_map(fn($bp) => $this->calculateSeatId($bp), $this->boardingPasses);
    }

    public function part1(): int
    {
        return max($this->calculateSeatIds());
    }

    public function part2(): int
    {
        $existingSeatIds = $this->calculateSeatIds();
        $candidates = array_diff(range(1, max($existingSeatIds)), $existingSeatIds);

        return current(
            array_values(
                array_filter(
                    $candidates,
                    fn($seat) => in_array($seat - 1, $existingSeatIds) && in_array($seat + 1, $existingSeatIds)
                )
            )
        );
    }
}
