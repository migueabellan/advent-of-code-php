<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Day01\Index as Day01;
use App\Day02\Index as Day02;

/*
$day01 = new Day01();

$ini = (microtime(true) * 1000);
$day01->withFor();
$end = (microtime(true) * 1000);
echo 'With FOR: '. ($end - $ini) . "\n";

$ini = (microtime(true) * 1000);
$day01->withDoWhile();
$end = (microtime(true) * 1000);
echo 'With DOWHILE: '. ($end - $ini) . "\n";
*/

$ini = (microtime(true) * 1000);
$day02 = new Day02();
$day02->puzzle2();
$end = (microtime(true) * 1000);
echo 'Time: '. ($end - $ini) . "\n";
