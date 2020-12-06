<?php
declare(strict_types=1);

use AoC20\Day6\Day6;
use PHPUnit\Framework\TestCase;

class Day6Test extends TestCase
{
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
        self::assertEquals(11, (new Day6($sample))->part1());
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

    public function testMapGroupAnswers(): void
    {
        self::assertEquals(['a','b','c'], Day6::mapGroupAnswers(['ab','ac']));
    }
}
