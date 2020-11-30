<?php

function read(): array
{
    $array = [];

    if ($file = fopen(getcwd().'/base/_in.txt', 'r')) {
        while(!feof($file)) {
            if ($line = fgets($file)) {
                $array[] = $line;
            }
        }
        fclose($file);
    }

    return $array;
}

function write(array $array): void
{
    $base = dirname(__FILE__);
    $file = fopen($base.'/_out.txt', 'w');

    foreach ($array as $key => $value) {
        fwrite($file, $value);
        if ($key !== count($array) - 1) {
            fwrite($file, "\n");
        }
    }

    fclose($file);
}

// main

$array = read();

foreach ($array as $key => $value) {
    $array[$key] = $value;
}

write($array);
