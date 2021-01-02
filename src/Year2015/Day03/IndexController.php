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
        $house = new House();
        $house->addPresent(0, 0);

        $santa = new Person();

        foreach ($array as $location) {
            $santa->move($location);

            $house->addPresent($santa->getX(), $santa->getY());
        }
        
        return (string)$house->getPresents();
    }

    public function exec2(array $array = []): string
    {
        $house = new House();
        $house->addPresent(0, 0);

        $santa = new Person();
        $elf = new Person();

        foreach ($array as $k => $location) {
            if ($k % 2 == 0) {
                $santa->move($location);
                $house->addPresent($santa->getX(), $santa->getY());
            } else {
                $elf->move($location);
                $house->addPresent($elf->getX(), $elf->getY());
            }
        }

        return (string)$house->getPresents();
    }
}
