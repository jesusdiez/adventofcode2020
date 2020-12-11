<?php
declare(strict_types=1);

use AoC20\Day8\Day8;
use PHPUnit\Framework\TestCase;

class Day8Test extends TestCase
{
    private Day8 $sut;
    private string $input;

    protected function setUp(): void
    {
        parent::setUp();
        $this->input = <<<EOF
nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6
EOF;
        $this->sut = new Day8($this->input);
    }

    public function testParseLine(): void
    {
        $line = "jmp +116";
        self::assertEquals(['jmp', '+116'], Day8::parseLine($line));
    }

    public function testParseInput(): void
    {
        $expected = [
            0 => ['nop', +0],
            1 => ['acc', +1],
            2 => ['jmp', +4],
            3 => ['acc', +3],
            4 => ['jmp', -3],
            5 => ['acc', -99],
            6 => ['acc', +1],
            7 => ['jmp', -4],
            8 => ['acc', +6],
        ];
        self::assertEquals($expected, Day8::parseInput($this->input));
    }

    public function testExecute(): void
    {
        $program = Day8::parseInput($this->input);
        self::assertEquals([1, 0, [0]], $this->sut->execute($program, 0, 0));
    }

    public function testPart1(): void
    {
        self::assertEquals(5, $this->sut->part1());
    }

    public function testPart2(): void
    {
        self::assertEquals(8, $this->sut->part2());
    }
}
