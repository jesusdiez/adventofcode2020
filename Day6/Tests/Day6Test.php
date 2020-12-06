<?php
declare(strict_types=1);

use AoC20\Day6\Day6;
use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
    public static $sample = <<<EOF
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

    public function testPart1Simple()
    {
        $sample = <<<EOF
abcx
abcy
abcz
EOF;
        self::assertEquals(6, (new Day6($sample))->part1());
    }

    public function testPart1()
    {
        self::assertEquals(11, (new Day6(self::$sample))->part1());
    }

    public function testMapPersonAnswer(): void
    {
        $input = <<<EOF
a

b

c
EOF;
        self::assertEquals(['a','b','c'], Day6::splitInputStrInArrayOfGroups($input));
    }

    public function testMapGroupAnswersPart1(): void
    {
        self::assertEquals(['a','b','c'], Day6::mapGroupAnswersPart1(['ab','ac']));
    }

    public function testMapGroupAnswersPart2(): void
    {
        self::assertEquals(['a'], Day6::mapGroupAnswersPart2(['ab','ac']));
    }

    public function testPart2()
    {
        self::assertEquals(6, (new Day6(self::$sample))->part2());
    }
}
