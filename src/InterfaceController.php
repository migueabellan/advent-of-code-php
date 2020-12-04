<?php

namespace App;

/**
 * Provides common features needed
 *
 * @author Miguel Ángel Abellán <info@migueabellan.es>
 */
interface InterfaceController
{
    /**
     * Map input file to array
     *
     * @return array
     */
    public function read(): array;

    /**
     * Write output in
     *
     * @param string $string
     * 
     * @return void
     */
    public function write(string $string): void;
}