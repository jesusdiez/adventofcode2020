<?php
declare(strict_types=1);

use AoC20\Day10\Day10;
use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    private Day10 $sut;
    private string $input;

    protected function setUp(): void
    {
        parent::setUp();
        $this->input = <<<EOF
16
10
15
5
1
11
7
19
6
12
4
EOF;
        $this->sut = new Day10($this->input);
    }

    public function testFirstNotValid(): void
    {
        self::assertEquals(35, $this->sut->calculate(Day10::parseInput($this->input)));
    }
}
