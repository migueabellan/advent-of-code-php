<?php

namespace App\Controller;

/**
 * Provides common features needed
 *
 * @author Miguel Ángel Abellán <info@migueabellan.es>
 */
abstract class AbstractController implements InterfaceController
{
    /**
     * @var float
     */
    protected float $ini_time = 0;

    public function __construct()
    {
        $this->ini_time = microtime(true) * 1000;
    }
    
    /**
     * Get path of the input file
     *
     * @return string
     */
    protected function getPathIn(): string
    {
        $path = (string)(new \ReflectionClass($this))->getFileName();

        $name = (string)(new \ReflectionClass($this))->getShortName();

        return str_replace($name.'.php', '_in.txt', $path);
    }

    /**
     * Map input file to array in default mode
     *
     * @see InterfaceController
     */
    public function read(): array
    {
        return (array)file($this->getPathIn(), FILE_IGNORE_NEW_LINES);
    }

    /**
     * Write output in a console
     *
     * @see InterfaceController
     */
    public function write(string $string): void
    {
        echo "\nResult: \e[0;30;42m " . $string . " \e[0m\n\n";

        echo 'Time: ' . ((microtime(true) * 1000) - $this->ini_time) . "\n";
    }
}
