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
        return array_map(fn($i) => (int) $i, array_filter(explode(PHP_EOL, $contents)));
    }

    public function firstNotValid(array $data, int $preambleSize): int
    {
        $count = count($data);
        for ($i = $preambleSize; $i < $count; $i++) {
            $preamble = \array_slice($data, $i - $preambleSize, $preambleSize);
            $current = $data[$i];
            $complementaryPreamble = array_map(fn($v) => -1 * ($v - $current), $preamble);
            $complementaryIntersect = array_unique(array_values(array_intersect($preamble, $complementaryPreamble)));
            if (count($complementaryIntersect) < 2) {
                return (int) $current;
            }
        }

        // All match
        return -1;
    }

    public function encryptionWeakness(array $data, int $preambleSize): int
    {
        $firstNotValid = $this->firstNotValid($data, $preambleSize);
        foreach ($data as $ki => $i) {
            $acc = $i;
            $subData = array_slice($data, $ki + 1);
            foreach ($subData as $kj => $j) {
                $acc += $j;
                if ($acc > $firstNotValid) {
                    break;
                }
                if ($acc === $firstNotValid) {
                    $range = array_slice($data, $ki, $kj+2);

                    return min($range) + max($range);
                }
            }
        }

        return -1;
    }

    public function part1(): int
    {
        return $this->firstNotValid($this->data, 25);
    }

    public function part2(): int
    {
        return $this->encryptionWeakness($this->data, 25);
    }
}
