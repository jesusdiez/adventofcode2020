<?php
declare(strict_types=1);

use AoC20\Day7\Day7;
use PHPUnit\Framework\TestCase;

class Day7Test extends TestCase
{
    private Day7 $sut;
    private string $input;

    protected function setUp(): void
    {
        parent::setUp();
        $this->input = <<<EOF
light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.
EOF;
        $this->sut = new Day7($this->input);
    }

    public function testParseLine(): void
    {
        $line = "light red bags contain 1 bright white bag, 2 muted yellow bags.";

        self::assertEquals(['light red' => ['bright white' => 1, 'muted yellow' => 2]], Day7::parseLine($line));
    }

    public function testParseInput(): void
    {
        $expected = [
            'light red' => ['bright white' => 1, 'muted yellow' => 2],
            'dark orange' => ['bright white' => 3, 'muted yellow' => 4],
            'bright white' => ['shiny gold' => 1],
            'muted yellow' => ['shiny gold' => 2, 'faded blue' => 9],
            'shiny gold' => ['dark olive' => 1, 'vibrant plum' => 2],
            'dark olive' => ['faded blue' => 3, 'dotted black' => 4],
            'vibrant plum' => ['faded blue' => 5, 'dotted black' => 6],
            'faded blue' => [],
            'dotted black' => [],
        ];

        self::assertEquals($expected, Day7::parseInput($this->input));
    }

    public function testCanContainDirect(): void
    {
        $expected = ['bright white', 'muted yellow'];
        self::assertEquals($expected, $this->sut->canContainDirect('shiny gold'));
    }

    public function testCanContainDeep(): void
    {
        $expected = ['bright white', 'muted yellow', 'light red', 'dark orange', ];
        self::assertEquals($expected, $this->sut->canContainDeep('shiny gold'));
    }
}
