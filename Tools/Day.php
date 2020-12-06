<?php
declare(strict_types=1);

namespace AoC20\Tools;

interface Day
{
    public static function parseInput(string $input): array;
    public function part1(): int;
    public function part2(): int;
}
