<?php
 
namespace App\Year2024\Day04;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];
 
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $array[] = str_split(trim($line));
            }
            fclose($file);
        }
  
        return $array;
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        $word = 'XMAS';

        $coorddinates = [
            [-1, -1], [-1, +0], [-1, 1],
            [+0, -1], /*******/ [+0, 1],
            [+1, -1], [+1, +0], [+1, 1],
        ];

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input); $j++) {
                if ($input[$i][$j] === $word[0]) {
                    foreach ($coorddinates as $coordinate) {
                        $_i = $i;
                        $_j = $j;
                        $acc = $word[0];
                        while (str_starts_with($word, $acc)) {
                            $_i += $coordinate[0];
                            $_j += $coordinate[1];
                            if (!isset($input[$_i][$_j])) {
                                break;
                            }
                
                            $acc .= $input[$_i][$_j];
                
                            if ($word === $acc) {
                                $result++;
                            }
                        }
                    }
                }
            }
        }
  
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        $words = ['MAS', 'SAM'];

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input); $j++) {
                if ($input[$i][$j] === 'A') {
                    $tl = $input[$i + 1][$j - 1] ?? '';
                    $tr = $input[$i + 1][$j + 1] ?? '';
                    $bl = $input[$i - 1][$j - 1] ?? '';
                    $br = $input[$i - 1][$j + 1] ?? '';

                    if (in_array($tl.'A'.$br, $words) && in_array($tr.'A'.$bl, $words)) {
                        $result++;
                    }
                }
            }
        }

        return $result;
    }
}
