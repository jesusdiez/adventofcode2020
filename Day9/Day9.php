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

    public function analyze(array $data, int $preambleSize): int
    {
        $count = count($data);
        for ($i=$preambleSize; $i<$count; $i++) {
            $preamble = \array_slice($data, $i-$preambleSize, $preambleSize);
            $current = $data[$i];
            $complementaryPreamble = array_map(fn($v) => -1*($v - $current), $preamble);
            $complementaryIntersect = array_unique(array_values(array_intersect($preamble, $complementaryPreamble)));
            if (count($complementaryIntersect) < 2) {
                return (int) $current;
            }
        }
        // All match
        return -1;
    }

    public function part1(): int
    {
        return $this->analyze($this->data, 25);
    }

    public function part2(): int
    {
        return -1;
    }
}
