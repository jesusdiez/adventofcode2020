<?php
declare(strict_types=1);

namespace AoC\Day1;

// require_once(__DIR__ . '/../vendor/autoload.php');

final class Day1
{
    public static function main(): void
    {
        $numbers = \array_map(fn($n) => (int) trim($n), file(__DIR__ . '/input'));
        $complementaries = \array_map(fn($n) => (2020 - (int) $n), $numbers);
        $couple = array_intersect($numbers, $complementaries);

        echo current($couple) * end($couple);
    }
}

Day1::main();
