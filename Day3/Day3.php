<?php
declare(strict_types=1);

namespace AoC\Day3;

final class Day3
{
    private const TREE = '#';

    public static function main1(): void
    {
        $map = self::parseInput();
        $treeCount = self::treeCount($map, 3,1);

        printf("Part 1.\nTree count: %d\n", $treeCount);
    }

    public static function main2(): void
    {
        $map = self::parseInput();
        $slopes = [
            [1,1],
            [3,1],
            [5,1],
            [7,1],
            [1,2],
        ];
        $results = array_map(
            fn($slope) => self::treeCount($map, $slope[0], $slope[1]),
            $slopes
        );

        printf("Part 2.\nResults: %s.\nTotal Trees: %d\n", json_encode($results), array_product($results));
    }

    private static function treeCount(array $map, int $speedX, int $speedY): int
    {
        $height = count($map);
        $width = count(reset($map));

        $x = 0;
        $treeCount = 0;
        for ($y = 0; $y < $height - 1; $y += $speedY) {
            $x += $speedX;
            if ($x > $width - 1) {
                $x = $x % $width;
            }
            $currentPos = $map[$y + $speedY][$x];
            $treeCount += $currentPos == self::TREE ? 1 : 0;
        }

        return $treeCount;
    }

    private static function parseInput(): array
    {
        return array_map(fn($line) => str_split(trim($line)), file(__DIR__ . '/input'));
    }
}

Day3::main1();
Day3::main2();
