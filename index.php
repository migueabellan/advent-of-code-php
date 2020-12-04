<?php

require_once __DIR__ . '/vendor/autoload.php';

$advent = (int)$argv[1] <= 9 ? "0$argv[1]" : $argv[1];
$puzzle = (int)$argv[2];

$class = "App\\Controller\\Day$advent";

$runner = new $class();

$ini = (microtime(true) * 1000);

switch ($puzzle) {
    case 1:
        $runner->exec1();
        break;
    case 2:
        $runner->exec2();
        break;
    default:
        echo "Error \n";
}

$end = (microtime(true) * 1000);
echo 'Time: '. ($end - $ini) . "\n";
