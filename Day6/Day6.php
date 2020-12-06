<?php
declare(strict_types=1);

namespace AoC20\Day6;

use AoC20\Tools\Day;

final class Day6 implements Day
{
    private array $groupAnswers;

    public function __construct(string $inputContent)
    {
        $this->groupAnswers = self::parseInput($inputContent);
//        echo json_encode($this->groupAnswers, \JSON_PRETTY_PRINT);
//        die;
    }

    public static function parseInput(string $contents): array
    {
        return array_map(
            fn(string $groupStr):array => array_filter(explode(PHP_EOL, $groupStr)),
            self::splitInputStrInArrayOfGroups($contents)
        );
    }

    public static function mapGroupAnswers(array $groupAnswers): array
    {
        $ar = array_reduce(
            $groupAnswers,
            fn($carry, $personAnswer) => array_merge($carry, str_split($personAnswer)),
            []
        );

        echo "\nGroup Answers: ".json_encode($groupAnswers);
        echo "\nMerged: ".json_encode($ar);
        $ar = array_values(array_unique($ar));
        sort($ar);
        echo "\nUnique sort: ".json_encode($ar);
        echo "\nCount: ".count($ar);
        echo "\n";

        return array_values($ar);
    }

    public static function splitInputStrInArrayOfGroups(string $contents): array
    {
        return explode(PHP_EOL . PHP_EOL, $contents);
    }

    public function part1(): int
    {
        $counts = array_map(
                fn($groupAnswers) => count(self::mapGroupAnswers($groupAnswers)),
                $this->groupAnswers
            );

        return array_sum($counts);
    }

    public function part2(): int
    {
        return -1;
    }
}
