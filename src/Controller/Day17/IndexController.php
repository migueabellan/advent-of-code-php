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

        $x = $y = $z = $w= 0;

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = str_split(trim($line));
                for ($y = 0; $y < count($line); $y++) {
                    $array['3d'][$x][$y][$z] = $line[$y];
                    
                    $array['4d'][$x][$y][$z][$w] = $line[$y];
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
        $aux = [];

        $first_x = (int)array_key_first($matrix) - self::CICLES;
        $last_x = (int)array_key_last($matrix) + self::CICLES;
        for ($x = $first_x; $x <= $last_x; $x++) {
            $first_y = array_key_first($matrix[0]) - self::CICLES;
            $last_y = array_key_last($matrix[0]) + self::CICLES;
            for ($y = $first_y; $y <= $last_y; $y++) {
                $first_z = array_key_first($matrix[0][0]) - self::CICLES;
                $last_z = array_key_last($matrix[0][0]) + self::CICLES;
                for ($k=$first_z; $k <= $last_z; $k++) {
                    if (!isset($matrix[$x][$y][$k])) {
                        $aux[$x][$y][$k] = self::INACTIVE;
                    } else {
                        $aux[$x][$y][$k] = $matrix[$x][$y][$k];
                    }
                }
            }
        }

        return $aux;
    }

    public function exec1(array $array = []): string
    {
        $matrix = $this->setStates3D($array['3d']);

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



    private function countNeighborsActives4D(array $matrix, int $x, int $y, int $z, int $w): int
    {
        $actives = 0;

        for ($i = $x-1; $i <= $x+1; $i++) {
            for ($j = $y-1; $j <= $y+1; $j++) {
                for ($k = $z-1; $k <= $z+1; $k++) {
                    for ($l = $w-1; $l <= $w+1; $l++) {
                        if (!($x === $i && $y === $j && $z === $k && $w === $l)) {
                            if (isset($matrix[$i][$j][$k][$l]) && $matrix[$i][$j][$k][$l] === self::ACTIVE) {
                                $actives++;
                            }
                        }
                    }
                }
            }
        }

        return $actives;
    }

    private function setStates4D(array $matrix): array
    {
        $aux = [];

        $first_x = (int)array_key_first($matrix) - self::CICLES;
        $last_x = (int)array_key_last($matrix) + self::CICLES;
        for ($i = $first_x; $i <= $last_x; $i++) {
            $first_j = array_key_first($matrix[0]) - self::CICLES;
            $last_j = array_key_last($matrix[0]) + self::CICLES;
            for ($j = $first_j; $j <= $last_j; $j++) {
                $first_k = array_key_first($matrix[0][0]) - self::CICLES;
                $last_k = array_key_last($matrix[0][0]) + self::CICLES;
                for ($k = $first_k; $k <= $last_k; $k++) {
                    $first_l = array_key_first($matrix[0][0][0]) - self::CICLES;
                    $last_l = array_key_last($matrix[0][0][0]) + self::CICLES;
                    for ($l = $first_l; $l <= $last_l; $l++) {
                        if (!isset($matrix[$i][$j][$k][$l])) {
                            $aux[$i][$j][$k][$l] = self::INACTIVE;
                        } else {
                            $aux[$i][$j][$k][$l] = $matrix[$i][$j][$k][$l];
                        }
                    }
                }
            }
        }

        return $aux;
    }

    public function exec2(array $array = []): string
    {
        $matrix = $this->setStates4D($array['4d']);

        $aux = $matrix;
        for ($c = 0; $c < self::CICLES; $c++) {
            foreach ($matrix as $x => $_) {
                foreach ($matrix[$x] as $y => $_) {
                    foreach ($matrix[$x][$y] as $z => $_) {
                        foreach ($matrix[$x][$y][$z] as $w => $_) {
                            $neighbors = $this->countNeighborsActives4D($matrix, $x, $y, $z, $w);
                            switch ($matrix[$x][$y][$z][$w]) {
                                case self::ACTIVE:
                                    if ($neighbors !== 2 && $neighbors !== 3) {
                                        $aux[$x][$y][$z][$w] = self::INACTIVE;
                                    }
                                    break;
                                case self::INACTIVE:
                                    if ($neighbors === 3) {
                                        $aux[$x][$y][$z][$w] = self::ACTIVE;
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
            $matrix = $aux;
        }


        $result = 0;
        foreach ($aux as $x => $_) {
            foreach ($aux[$x] as $y => $_) {
                foreach ($aux[$x][$y] as $z => $_) {
                    foreach ($matrix[$x][$y][$z] as $w => $_) {
                        if ($aux[$x][$y][$z][$w] === self::ACTIVE) {
                            $result++;
                        }
                    }
                }
            }
        }

        return (string)$result;
    }
}
