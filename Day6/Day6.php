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

    public static function mapGroupAnswersPart1(array $groupAnswers): array
    {
        $ar = array_reduce(
            $groupAnswers,
            fn($carry, $personAnswer) => array_merge($carry, str_split($personAnswer)),
            []
        );

//        echo "\nGroup Answers: ".json_encode($groupAnswers);
//        echo "\nMerged: ".json_encode($ar);
        $ar = array_values(array_unique($ar));
        sort($ar);
//        echo "\nUnique sort: ".json_encode($ar);
//        echo "\nCount: ".count($ar);
//        echo "\n";

        return array_values($ar);
    }

    public static function mapGroupAnswersPart2(array $groupAnswers): array
    {
        $peopleCount = count($groupAnswers);
        $countAnswers = array_reduce(
            $groupAnswers,
            function(array $carry, string $personAnswer) {
                $count = array_count_values(str_split($personAnswer));
                foreach($count as $k => $v) {
                    $carry[$k] = ($carry[$k] ?? 0) + $v;
                }
                return $carry;
            },
            []
        );
        $commonAnswers = array_filter($countAnswers, fn($v) => $v == $peopleCount);

//        echo "\nGroup Answers: ".json_encode($groupAnswers);
//        echo "\nCount Answers: ".json_encode($countAnswers);
//        echo "\nCommon Answers: ".json_encode($commonAnswers);
//        echo "\nCount: ".count($commonAnswers);
//        echo "\n";

        return array_keys($commonAnswers);
    }

    public static function splitInputStrInArrayOfGroups(string $contents): array
    {
        return explode(PHP_EOL . PHP_EOL, $contents);
    }

    public function part1(): int
    {
        $counts = array_map(
            fn($groupAnswers) => count(self::mapGroupAnswersPart1($groupAnswers)),
            $this->groupAnswers
        );

        return array_sum($counts);
    }

    public function part2(): int
    {
        $counts = array_map(
            fn($groupAnswers) => count(self::mapGroupAnswersPart2($groupAnswers)),
            $this->groupAnswers
        );

        return array_sum($counts);
    }
}
