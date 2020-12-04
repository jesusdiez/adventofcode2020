<?php
declare(strict_types=1);

namespace AoC\Day4;

final class Day4
{
    public static function main1(): void
    {
    }

    public static function main2(): void
    {
    }

    private static function parseInput(): array
    {
        return array_map(fn($line) => str_split(trim($line)), file(__DIR__ . '/input'));
    }
}

Day4::main1();
Day4::main2();
