<?php
declare(strict_types=1);

namespace AoC20\Tools;

final class AppFactory
{
    public static function get(string $day, string $inputFilename)
    {
        $className = sprintf('AoC20\Day%d\Day%d', $day, $day);
        $inputPath = sprintf('%s/../Day%s/%s', __DIR__, $day, $inputFilename);

        return new $className(file_get_contents($inputPath));
    }
}
