<?php
declare(strict_types=1);

namespace AoC\Day3;

final class Day3
{
    private const TREE = '#';

    public static function main1(): void
    {
        $speedX = 3;
        $map = self::parseInput();
        $height = count($map);
        $width = count(reset($map));

        $x = 0;
        $treeCount = 0;
        for ($y=0; $y<$height-1; $y++) {
            $x += $speedX;
            if ($x > $width - 1) {
                $x = $x % $width;
            }
            $currentPos = $map[$y+1][$x];
            $treeCount += $currentPos == self::TREE ? 1 : 0;
        }

        printf("Tree count: %d\n", $treeCount);
    }

    public static function main2(): void
    {
    }

    protected static function parseInput(): array
    {
        return array_map(fn($line) => str_split(trim($line)), file(__DIR__ . '/input'));
    }
}

Day3::main1();
