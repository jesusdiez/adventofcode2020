<?php
declare(strict_types=1);

namespace AoC20\Tools;

final class File
{
    public static function toString(string $filename): string
    {
        return \file_get_contents($filename);
    }
    
    public static function toArray(string $filename): array
    {
        return \file($filename);
    }
}
