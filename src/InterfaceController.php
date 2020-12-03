<?php

namespace App;

/**
 * Provides common features needed
 *
 * @author Miguel Ángel Abellán <info@migueabellan.es>
 */
interface InterfaceController
{
    public function read(): array;

    public function write(string $string): void;
}