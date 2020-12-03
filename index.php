<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Day01\Index as Day01;
use App\Day02\Index as Day02;
use App\Day03\Index as Day03;

$ini = (microtime(true) * 1000);

switch ($argv[1]) {
    case 'day1-for':
        $puzzle = new Day01();
        $puzzle->execFor();
        break;
    case 'day1-while':
        $puzzle = new Day01();
        $puzzle->execWhile();
        break;
    case 'day2-2':
        $puzzle = new Day02();
        $puzzle->exec1();
        break;
    case 'day2-2':
        $puzzle = new Day02();
        $puzzle->exec2();
        break;
    case 'day3-1':
        $puzzle = new Day03();
        $puzzle->exec1();
        break;
    case 'day3-2':
        $puzzle = new Day03();
        $puzzle->exec2();
        break;
}

$end = (microtime(true) * 1000);
echo 'Time: '. ($end - $ini) . "\n";
