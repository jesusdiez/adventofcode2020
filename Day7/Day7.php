<?php
declare(strict_types=1);

namespace AoC20\Day7;

use AoC20\Tools\Day;

final class Day7 implements Day
{
    private array $data;

    public function __construct(string $inputContent)
    {
        $this->data = self::parseInput($inputContent);
    }

    public static function parseLine(string $line): array
    {
        $patternMain = '/([a-z]+ [a-z]+) bags contain (.*)\.$/';
        $patternSub = '/(\d+) ([a-z]+ [a-z]+) bags?/';
        $matches = [];
        \preg_match($patternMain, $line, $matches);
        $main = $matches[1];
        $inside = $matches[2] ?? null;
        if ($inside === null) {
            return [$main => []];
        }

        $insideMap = array_reduce(
            explode(', ', $inside),
            function ($carry, $bag) use ($patternSub) {
                if (preg_match($patternSub, $bag, $matches)) {
                    $carry[$matches[2]] = $matches[1];
                };

                return $carry;
            },
            []
        );

        return [$main => $insideMap];
    }

    public static function parseInput(string $contents): array
    {
        return array_reduce(
            array_filter(explode(PHP_EOL, $contents)),
            fn(array $carry, string $line) => $carry += self::parseLine($line),
            []
        );
    }

    public function canContain(string $selColor): array
    {
        $canContain = array_reduce(
            array_keys($this->data),
            function (array $carry, $containerBagColor) use ($selColor) {
                if (\key_exists($selColor, $this->data[$containerBagColor])) {
                    array_push($carry, $containerBagColor);
                }

                return $carry;
            },
            []
        );

        return array_unique(
            array_reduce(
                $canContain,
                function (array $carry, $containerBagColor) {
                    return array_merge($carry, $this->canContain($containerBagColor));
                },
                $canContain
            )
        );
    }

    public function part1(): int
    {
        return count($this->canContain('shiny gold'));
    }

    public function part2(): int
    {
        return -1;
    }
}

