<?php

namespace App\Year2015\Day03;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array = str_split(trim($line));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $grid = new Grid();
        $grid->addPresent();

        foreach ($array as $location) {
            $grid->move($location);
            $grid->addPresent();
        }
        
        return (string)$grid->getPresents();
    }

    public function exec2(array $array = []): string
    {
        return (string)0;
    }
}
