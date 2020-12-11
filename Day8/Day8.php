<?php
declare(strict_types=1);

namespace AoC20\Day8;

use AoC20\Tools\Day;

final class Day8 implements Day
{
    private array $program;

    public function __construct(string $inputContent)
    {
        $this->program = self::parseInput($inputContent);
    }

    public static function parseLine(string $line): array
    {
        return explode(' ', $line);
    }

    public static function parseInput(string $contents): array
    {
        return array_map(
            fn(string $line) => self::parseLine($line),
            array_filter(explode(PHP_EOL, $contents))
        );
    }

    public function accBeforeRepeat(array $program): int
    {
        $acc = 0;
        $pointer = 0;
        $executed = [];
        while (!in_array($pointer, $executed)) {
            [$pointer, $acc, $executed] = $this->execute($program, $pointer, $acc, $executed);
        }

        return $acc;
    }

    public function fullExecute(array $program): array
    {
        $acc = 0;
        $pointer = 0;
        $executed = [];
//        $diff = \array_diff(array_map('json_encode', $this->program), array_map('json_encode', $program));
//        echo "\nDiff from fullExecute Program with this->program: ".json_encode($diff);
//        echo "\n Full execute! ";
        while (!in_array($pointer, $executed) && key_exists($pointer, $program)) {
            [$pointer, $acc, $executed] = $this->execute($program, $pointer, $acc, $executed);
        }

//        echo " > pt $pointer, acc $acc . already executed? " . (in_array($pointer, $executed) ? 'Y' : 'N');
        return [$pointer, $acc, $executed];
    }

    public function replaceAndContinue(array $program): int
    {
        $programSteps = count($program);
        foreach ($program as $k => $step) {
            $customProgram = array_merge($program, []);
            [$cmd, $arg] = $step;
            switch($cmd) {
                case 'jmp':
                    $customProgram[$k] = ['nop', $arg];
                    break;
                case 'nop':
                    $customProgram[$k] = ['jmp', $arg];
                    break;
                case 'acc':
                default:
                    break;
            }
            [$customPointer, $customAcc, $customExecuted] = $this->fullExecute($customProgram);
            if ($customPointer == $programSteps) {
                // Execution completed!
                return $customAcc;
            }
        }

        // No execution can be completed even with nop/jmp replacement
        return -1;
    }

    public function execute(array $program, int $pointer, int $acc, array $executed = []): array
    {
        [$cmd, $arg] = $program[$pointer];
        $executed[] = $pointer;
        switch ($cmd) {
            case 'jmp':
                $pointer += (int) $arg;
                break;
            case 'acc':
                $acc += (int) $arg;
                // no break
            case 'nop':
            default:
                $pointer++;
        }

        return [$pointer, $acc, $executed];
    }

    public function part1(): int
    {
        return $this->accBeforeRepeat($this->program);
    }

    public function part2(): int
    {
        return $this->replaceAndContinue($this->program);
    }
}
