<?php
 
namespace App\Year2024\Day05;
 
use App\Puzzle\AbstractPuzzle;
 
class Puzzle extends AbstractPuzzle
{
    private array $rules = [];

    public function read(): array
    {
        $array = [];
 
        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if ($line !== '') {
                    if (str_contains($line, ',')) {
                        $array[] = array_map('intval', explode(',', $line));
                    } else {
                        $rule = explode('|', $line);
                        $this->rules[$rule[0]][$rule[1]] = true;
                    }
                }
            }
            fclose($file);
        }
  
        return $array;
    }

    private function isUpdateValid(array $updates): bool
    {
        foreach ($this->rules as $k1 => $rules) {
            foreach ($rules as $k2 => $_) {
                $i1 = array_search($k1, $updates);
                $i2 = array_search($k2, $updates);

                if ($i1 !== false && $i2 !== false && $i1 > $i2) {
                    return false;
                }
            }
        }

        return true;
    }

    public function setValidUpdate(array $updates): array
    {
        for ($i = 0; $i < count($updates) - 1; $i++) {
            for ($j = $i + 1; $j < count($updates); $j++) {
                if (isset($this->rules[$updates[$i]][$updates[$j]])) {
                    $aux = $updates[$i];
                    $updates[$i] = $updates[$j];
                    $updates[$j] = $aux;
                }
            }
        }

        return $updates;
    }

    private function middleNumber(array $updates): int
    {
        return $updates[floor(count($updates) / 2)];
    }

    public function exec1(array $input = []): int
    {
        $result = 0;

        foreach ($input as $updates) {
            if ($this->isUpdateValid($updates)) {
                $result += $this->middleNumber($updates);
            }
        }
  
        return $result;
    }
 
    public function exec2(array $input = []): int
    {
        $result = 0;

        foreach ($input as $updates) {
            if (!$this->isUpdateValid($updates)) {
                $updates = $this->setValidUpdate($updates);
                $result += $this->middleNumber($updates);
            }
        }

        return $result;
    }
}
