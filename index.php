<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Day01\Index as Day01;

$day01 = new Day01();

$ini = (microtime(true) * 1000);
$day01->withFor();
$end = (microtime(true) * 1000);
echo 'With FOR: '. ($end - $ini) . "\n";

$ini = (microtime(true) * 1000);
$day01->withDoWhile();
$end = (microtime(true) * 1000);
echo 'With DOWHILE: '. ($end - $ini) . "\n";
