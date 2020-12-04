<?php

namespace App;

use ReflectionClass;

/**
 * Provides common features needed
 *
 * @author Miguel Ángel Abellán <info@migueabellan.es>
 */
abstract class AbstractController implements InterfaceController
{
    /**
     * Get path of the input file
     *
     * @return string
     */
    protected function getPathIn(): string
    {
        $class = (new \ReflectionClass($this))->getShortName();

        return dirname(__DIR__).'/public/'.$class.'_in.txt';
    }

    /**
     * Get path of the output file
     *
     * @return string
     */
    protected function getPathOut(): string
    {
        $class = (new \ReflectionClass($this))->getShortName();

        return dirname(__DIR__).'/public/'.$class.$this->file_out;
    }

    /**
     * Map input file to array in default mode
     * 
     * @see InterfaceController
     */
    public function read(): array
    {
        $file = fopen($this->getPathIn(), "r");

        while (($line = fgets($file)) !== false){
            $array[] = $line;
        }
        
        fclose($file);

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

        echo 'Time: ' . ((microtime(true) * 1000) - INI_TIME) . "\n";
    }
}
