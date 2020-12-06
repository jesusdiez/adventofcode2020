<?php
declare(strict_types=1);

namespace AoC20\Day3;

use AoC20\Tools\Day;

final class Day3 implements Day
{
    private const TREE = '#';
    private array $map;

    public function __construct(string $inputContent)
    {
        $this->map = self::parseInput($inputContent);
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

    public static function parseInput(string $content): array
    {
        return array_map(fn($line) => str_split(trim($line)), array_filter(explode(PHP_EOL, $content)));
    }

    public function part1(): int
    {
        return self::treeCount($this->map, 3, 1);
    }

    public function part2(): int
    {
        $slopes = [
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ];
        $results = array_map(
            fn($slope) => self::treeCount($this->map, $slope[0], $slope[1]),
            $slopes
        );

        return array_product($results);
    }
}
