<?php
declare(strict_types=1);

use AoC20\Day9\Day9;
use PHPUnit\Framework\TestCase;

class Day9Test extends TestCase
{
    private Day9 $sut;
    private string $input;

    protected function setUp(): void
    {
        parent::setUp();
        $this->input = <<<EOF
35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576
EOF;
        $this->sut = new Day9($this->input);
    }

    public function testFirstNotValid(): void
    {
        self::assertEquals(127, $this->sut->firstNotValid(Day9::parseInput($this->input), 5));
    }

    public function testEncryptionWeakness(): void
    {
        self::assertEquals(62, $this->sut->encryptionWeakness(Day9::parseInput($this->input), 5));
    }
}
