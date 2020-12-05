<?php

require_once __DIR__ . '/vendor/autoload.php';

define('BASE_PATH', dirname(realpath(__FILE__)));

$advent = (int)$argv[1] <= 9 ? "0$argv[1]" : $argv[1];
$puzzle = (int)$argv[2];

$class = "App\\Controller\\Day$advent";

$runner = new $class();

switch ($puzzle) {
    case 1:
        $array = $runner->read();
        $result = $runner->exec1($array);
        $runner->write($result);
        break;
    case 2:
        $array = $runner->read();
        $result = $runner->exec2($array);
        $runner->write($result);
        break;
    default:
        echo "\e[0;30;41m Wrong input \e[0m\n";
        echo "$ php index.php DayN PuzzleN \n";
}
