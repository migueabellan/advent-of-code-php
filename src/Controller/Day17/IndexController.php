<?php

namespace App\Controller\Day17;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const CICLES = 6;

    private const ACTIVE = '#';

    private const INACTIVE = '.';

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        $x = $y = $z = 0;

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = str_split(trim($line));
                for ($y=0; $y<count($line); $y++) {
                    $array[$x][$y][$z]=$line[$y];
                }
                $x++;
            }
            fclose($file);
        }

        return $array;
    }
    


    private function countNeighborsActives3D(array $array, int $x, int $y, int $z): int
    {
        $actives = 0;

        for ($i = $x-1; $i <= $x + 1; $i++) {
            for ($j = $y-1; $j <= $y + 1; $j++) {
                for ($k = $z-1; $k <= $z + 1; $k++) {
                    if (!($x === $i && $y === $j && $z === $k)) {
                        if (isset($array[$i][$j][$k]) && $array[$i][$j][$k] === self::ACTIVE) {
                            $actives++;
                        }
                    }
                }
            }
        }

        return $actives;
    }

    private function setStates3D(array $matrix): array
    {
        $first_x = array_key_first($matrix) - self::CICLES;
        $last_x = array_key_last($matrix) + self::CICLES;
        for ($x = $first_x; $x <= $last_x; $x++) {
            $first_y = array_key_first($matrix[0]) - self::CICLES;
            $last_y = array_key_last($matrix[0]) + self::CICLES;
            for ($y = $first_y; $y <= $last_y; $y++) {
                $first_z = array_key_first($matrix[0][0]) - self::CICLES;
                $last_z = array_key_last($matrix[0][0]) + self::CICLES;
                for ($k=$first_z; $k <= $last_z; $k++) {
                    if (!isset($matrix[$x][$y][$k])) {
                        $matrix[$x][$y][$k] = self::INACTIVE;
                    }
                }
            }
        }

        return $matrix;
    }

    public function exec1(array $array = []): string
    {
        $matrix = $this->setStates3D($array);

        $aux = $matrix;
        for ($c = 0; $c < self::CICLES; $c++) {
            foreach ($matrix as $x => $_) {
                foreach ($matrix[$x] as $y => $_) {
                    foreach ($matrix[$x][$y] as $z => $_) {
                        $neighbors = $this->countNeighborsActives3D($matrix, $x, $y, $z);
                        switch ($matrix[$x][$y][$z]) {
                            case self::ACTIVE:
                                if ($neighbors !== 2 && $neighbors !== 3) {
                                    $aux[$x][$y][$z] = self::INACTIVE;
                                }
                                break;
                            case self::INACTIVE:
                                if ($neighbors === 3) {
                                    $aux[$x][$y][$z] = self::ACTIVE;
                                }
                                break;
                        }
                    }
                }
            }
            $matrix = $aux;
        }


        $actives = 0;
        foreach ($aux as $x => $_) {
            foreach ($aux[$x] as $y => $_) {
                foreach ($aux[$x][$y] as $z => $_) {
                    if ($aux[$x][$y][$z] === self::ACTIVE) {
                        $actives++;
                    }
                }
            }
        }

        return (string)$actives;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
