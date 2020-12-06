<?php
declare(strict_types=1);

use AoC20\Day5\Day5;
use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{
    /** @dataProvider providerDecode */
    public function testDecode($value, $sample)
    {
        $sut = new Day5($sample);

        self::assertEquals($value, [44, 5], $sut->decode());
    }

    public function providerDecode()
    {
        return [
            [[44, 5], 'FBFBBFFRLR'],
            [[70, 7], 'BFFFBBFRRR'],
            [[14, 7], 'FFFBBBFRRR'],
            [[102, 4], 'BBFFBBFRLL'],
        ];
    }

    public function testPart1OnlyOneEntry()
    {
        $sample = 'FBFBBFFRLR';
        $sut = new Day5($sample);

        self::assertEquals(357, $sut->part1());
    }

    public function testPart1MaxValue()
    {
        $sample = <<<EOF
BFFFBBFRRR
FFFBBBFRRR
BBFFBBFRLL
EOF;
        $sut = new Day5($sample);

        self::assertEquals(820, $sut->part1());
    }
}
