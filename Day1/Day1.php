<?php
declare(strict_types=1);

namespace AoC\Day1;

// require_once(__DIR__ . '/../vendor/autoload.php');

final class Day1
{
    public static function main1(): void
    {
        $numbers = \array_map(fn($n) => (int) trim($n), file(__DIR__ . '/input'));
        $complementaries = \array_map(fn($n) => (2020 - (int) $n), $numbers);
        $couple = array_intersect($numbers, $complementaries);

        echo current($couple) * end($couple);
    }

    public static function main2(): void
    {
        $numbers = \array_map(fn($n) => (int) trim($n), file(__DIR__ . '/input'));
        foreach ($numbers as $n) {
            $pending = 2020 - $n;
            foreach ($numbers as $n2) {
                if ($n2 == $n) continue;
                $pending2 = $pending-$n2;
                if (!empty(array_search($pending2, $numbers))) {
                    echo $n*$n2*$pending2;
                    return;
                }
            }
        }
    }
}

Day1::main1();
Day1::main2();
