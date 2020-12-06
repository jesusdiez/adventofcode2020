<?php
declare(strict_types=1);

namespace AoC20\Day1;

use AoC20\Tools\Day;

final class Day1 implements Day
{
    private array $numbers;

    public function __construct(string $inputContent)
    {
        $this->numbers = self::parseInput($inputContent);
    }

    public static function parseInput(string $input): array
    {
        return array_map(fn($n) => (int) trim($n), explode(PHP_EOL, $input));
    }

    public function part1(): int
    {
        $complementaries = \array_map(fn($n) => (2020 - (int) $n), $this->numbers);
        $couple = array_intersect($this->numbers, $complementaries);

        return current($couple) * end($couple);
    }

    public function part2(): int
    {
        foreach ($this->numbers as $n) {
            $pending = 2020 - $n;
            foreach ($this->numbers as $n2) {
                if ($n2 == $n) continue;
                $pending2 = $pending-$n2;
                if (!empty(array_search($pending2, $this->numbers))) {
                    return $n*$n2*$pending2;
                }
            }
        }
    }
}
