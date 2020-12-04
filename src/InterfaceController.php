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

    /**
     * Algorithm for first puzzle
     *
     * @return void
     */
    public function exec1(): void;

    /**
     * Algorithm for second puzzle
     *
     * @return void
     */
    public function exec2(): void;
}