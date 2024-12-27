<?php

namespace App\Puzzle;

/**
 * Provides common features needed
 *
 * @author Miguel Ángel Abellán
 */
abstract class AbstractPuzzle implements InterfacePuzzle
{
    private float $startTime = 0;

    public function __construct()
    {
        $this->startTime = microtime(true) * 1000;
    }
    
    /**
     * Get path of the input file
     */
    public function getPathIn(): string
    {
        $path = (string)(new \ReflectionClass($this))->getFileName();

        $name = (string)(new \ReflectionClass($this))->getShortName();

        return str_replace($name.'.php', '_in.txt', $path);
    }

    /**
     * Map input file to array in default mode
     */
    public function read(): array
    {
        return (array)file($this->getPathIn(), FILE_IGNORE_NEW_LINES);
    }

    /**
     * Write output in a console
     */
    public function write(string $string): void
    {
        echo "Result: \e[0;30;42m " . $string . " \e[0m\n\n";

        echo 'Time: ' . round((microtime(true) * 1000) - $this->startTime, 2) . " ms\n";
        echo 'Usage: ' . round(memory_get_peak_usage() / 1024 / 1024, 2) . " MBs\n";
    }
}
