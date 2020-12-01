<?php

function read(): array
{
    $array = [];

    $in = fopen(dirname(__FILE__).'/_in.txt', 'r');
    while (($line = fgets($in)) !== false) {
        $array[] = (int)$line;
    }
    fclose($in);

    sort($array);

    return $array;
}

function write(array $array): void
{
    $out = fopen(dirname(__FILE__).'/_out.txt', 'w');
    foreach ($array as $value) {
        fwrite($out, $value."\n");
    }
    fclose($out);
}


function main(): void
{
    $array = read();

    $result = [];    
    for($i = 0; $i < count($array); $i++) {
        for($j = $i + 1; $j < count($array); $j++) {
            for($k = $j + 1; $k < count($array); $k++) {
                if ($array[$i] + $array[$j] + $array[$k] === 2020) {
                    $result[] = $array[$i] * $array[$j] * $array[$k];
                }
            }
        }
    }

    write($result);
}

function refactor(): void
{
    $array = read();

    $result = [];
    $i = 0;
    do {
        $one = $array[$i];
        $j = $i + 1;
        do {
            $two = $array[$i] + $array[$j];
            $k = $j + 1;
            do {
                $three = $array[$i] + $array[$j] + $array[$k];
                if ($three === 2020) {
                    $result[] = $array[$i] * $array[$j] * $array[$k];
                }
            } while($k++ && $three < 2020 && $k < count($array) - 1);
        } while($j++ && $two < 2020 && $j < count($array) - 1);
    } while($i++ && $one < 2020 && $i < count($array) - 1);

    write($result);
}


$ini = (microtime(true) * 1000);
main();
$end = (microtime(true) * 1000);
echo 'With FOR: '. ($end - $ini) . "\n";
// > With FOR: 54.929931640625

$ini = (microtime(true) * 1000);
refactor();
$end = (microtime(true) * 1000);
echo 'With DOWHILE: '. ($end - $ini) . "\n";
// > With DOWHILE: 0.194091796875
