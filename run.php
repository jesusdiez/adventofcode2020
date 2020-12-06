<?php
declare(strict_types=1);

use AoC20\Tools\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';

$app = AppFactory::get($argv[1], 'input');
printf("Part 1. %s\n", $app->part1());
printf("Part 2. %s\n", $app->part2());
