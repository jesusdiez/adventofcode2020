<?php
declare(strict_types=1);

use AoC20\Day6\Day6;
use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    public function testPart1()
    {
        $sample = <<<EOF
abc

a
b
c

ab
ac

a
a
a
a

b
EOF;
        $sut = new Day6($sample);

        self::assertEquals(11, $sut->part1());
    }
}
