<?php
declare(strict_types=1);

use AoC20\Day4\Day4;
use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    private Day4 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day4(__DIR__ . '/../sample');
    }

    public function testParse()
    {
        self::assertEquals(2, $this->sut->part1());
    }
}
