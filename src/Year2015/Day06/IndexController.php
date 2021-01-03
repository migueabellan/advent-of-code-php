<?php

namespace App\Year2015\Day06;

use App\Controller\AbstractController;
use App\Year2015\Day06\Grid;

class IndexController extends AbstractController
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'inst'.*) (?'ini'.*) through (?'end'.*)$~", $line, $matches);

                $array[] = [
                    'inst' => $matches['inst'],
                    'ini' => explode(',', $matches['ini']),
                    'end' => explode(',', $matches['end']),
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $grid = new Grid();

        foreach ($array as $instruction) {
            for ($x = $instruction['ini'][0]; $x <= $instruction['end'][0]; $x++) {
                for ($y = $instruction['ini'][1]; $y <= $instruction['end'][1]; $y++) {
                    $grid->setLight($x, $y, $instruction['inst']);
                }
            }
        }

        return (string)$grid->getNumLights();
    }

    public function exec2(array $array = []): string
    {
        $result = 0;
        
        //

        return (string)$result;
    }
}
