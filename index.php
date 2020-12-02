<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Day01\Index as Day01;
use App\Day02\Index as Day02;

$ini = (microtime(true) * 1000);

switch ($argv[1]) {
    case 'day1-for':
        Day01::withFor();
        break;
    case 'day1-while':
        Day01::withDoWhile();
        break;
    case 'day2-2':
        Day02::puzzle2();
        break;
    case 'day2-2':
        Day02::puzzle2();
        break;
}

$end = (microtime(true) * 1000);
echo 'Time: '. ($end - $ini) . "\n";
