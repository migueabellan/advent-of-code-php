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
     * @var string
     */
    protected $file_in = '_in.txt';

    /**
     * @var string
     */
    protected $file_out = '_out.txt';

    /**
     * Get path of the input file
     *
     * @return string
     */
    protected function getPathIn(): string
    {
        $rc = new ReflectionClass(get_class($this));

        return dirname($rc->getFileName()) . '/' . $this->file_in;
    }

    /**
     * Get path of the output file
     *
     * @return string
     */
    protected function getPathOut(): string
    {
        $rc = new ReflectionClass(get_class($this));

        return dirname($rc->getFileName()) . '/' . $this->file_out;
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
     * Write output in a file in default mode
     * 
     * @see InterfaceController
     */
    public function write(string $string): void
    {
        $out = fopen($this->getPathOut(), 'w');

        fwrite($out, $string);

        fclose($out);
    }
}