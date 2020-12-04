<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\Day01;
use App\Controller\Day02;
use App\Controller\Day03;
use App\Controller\Day04;

$d1 = new Day01();
$d2 = new Day02();
$d3 = new Day03();
$d4 = new Day04();

$ini = (microtime(true) * 1000);

switch ($argv[1]) {
    case 'day1-for':
        $d1->execFor();
        break;
    case 'day1-while':
        $d1->execWhile();
        break;

    case 'day2-1':
        $d2->exec1();
        break;
    case 'day2-2':
        $d2->exec2();
        break;

    case 'day3-1':
        $d3->exec1();
        break;
    case 'day3-2':
        $d3->exec2();
        break;

    case 'day4-1':
        $d4->exec1();
        break;
    case 'day4-2':
        $d4->exec2();
        break;
}

$end = (microtime(true) * 1000);
echo 'Time: '. ($end - $ini) . "\n";
