<?php
declare(strict_types=1);

use AoC20\Day4\Day4;
use PHPUnit\Framework\TestCase;

class Day4Test extends TestCase
{
    public function testPart1()
    {
        $sample = <<<EOF
ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in
EOF;
        $sut = new Day4($sample);

        self::assertEquals(2, $sut->part1());
    }

    public function testPart2()
    {
        $sample = <<<EOF
ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in
EOF;
        $sut = new Day4($sample);

        self::assertEquals(2, $sut->part2());
    }

    public function testPart2Valids()
    {
        $sample = <<<EOF
pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
hcl:#623a2f

eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm

hcl:#888785
hgt:164cm byr:2001 iyr:2015 cid:88
pid:545766238 ecl:hzl
eyr:2022

iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719
EOF;
        $sut = new Day4($sample);

        self::assertEquals(4, $sut->part2());
    }

    public function testPart2Invalids()
    {
        $sample = <<<EOF
eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926

iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946

hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277

hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007
EOF;
        $sut = new Day4($sample);

        self::assertEquals(0, $sut->part2());
    }

    /** @dataProvider providerInputReal */
    public function testInputReal(bool $expected, string $input): void
    {
        $sut = new Day4($input);
        self::assertEquals($expected ? 1 : 0, $sut->part2());
    }

    /** Using some real cases from my personal input **/
    public function providerInputReal(): array
    {
        return [
            [true, 'byr:1937
eyr:2030 pid:154364481
hgt:158cm iyr:2015 ecl:brn hcl:#c0946f cid:155'],
            [false, 'cid:279
eyr:2029
pid:675014709 ecl:amb
byr:1985 hgt:179in hcl:z iyr:2025'],
            [true, 'iyr:2011 hgt:181cm hcl:#341e13 pid:282499883 byr:1953
eyr:2023
ecl:brn'],
            [false, 'eyr:2040 iyr:1984 pid:2371396209 byr:1951 cid:283 hgt:164cm
hcl:#623a2f'],
            [true, 'iyr:2014 byr:1966 hgt:153cm pid:900693718 eyr:2020 ecl:gry hcl:#866857'],
            [true, 'eyr:2020 hgt:162cm
byr:1939 pid:900852891 iyr:2020
ecl:oth hcl:#b6652a'],
        ];
    }
}
