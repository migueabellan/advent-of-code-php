<?php

namespace App;

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
        $class = (new \ReflectionClass($this))->getShortName();

        return '/app/public/'.$class.'_in.txt';
    }

    /**
     * Map input file to array in default mode
     *
     * @see InterfaceController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = $line;
            }
            fclose($file);
        }
        
        return $array;
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
