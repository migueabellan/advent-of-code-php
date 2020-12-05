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
     * @param array $array
     * 
     * @return string
     */
    public function exec1(array $array = []): string;

    /**
     * Algorithm for second puzzle
     * 
     * @param array $array
     *
     * @return string
     */
    public function exec2(array $array = []): string;
}