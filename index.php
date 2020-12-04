<?php

require_once __DIR__ . '/vendor/autoload.php';

define("INI_TIME", (microtime(true) * 1000));
define('BASE_PATH', dirname(realpath(__FILE__)));
define('PUBLIC_PATH', BASE_PATH . '/public/');

$advent = (int)$argv[1] <= 9 ? "0$argv[1]" : $argv[1];
$puzzle = (int)$argv[2];

$class = "App\\Controller\\Day$advent";

$runner = new $class();

switch ($puzzle) {
    case 1:
        $runner->exec1();
        break;
    case 2:
        $runner->exec2();
        break;
    default:
        echo "\e[0;30;41m Wrong input \e[0m\n";
        echo "$ php index.php DayN PuzzleN \n";
}
