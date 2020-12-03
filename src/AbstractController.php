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

    protected function getPathIn(): string
    {
        $rc = new ReflectionClass(get_class($this));

        return dirname($rc->getFileName()) . '/' . $this->file_in;
    }

    protected function getPathOut(): string
    {
        $rc = new ReflectionClass(get_class($this));

        return dirname($rc->getFileName()) . '/' . $this->file_out;
    }

    public function read(): array
    {
        $file = fopen($this->getPathIn(), "r");

        while (($line = fgets($file)) !== false){
            $array[] = $line;
        }
        
        fclose($file);

        return $array;
    }

    public function write(string $string): void
    {
        $out = fopen($this->getPathOut(), 'w');

        fwrite($out, $string);

        fclose($out);
    }
}