<?php

namespace App\Year2015\Day19;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public string $molecule = '';

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                if ($line && preg_match("~^(?'search'.*) => (?'replace'.*)$~", $line, $matches)) {
                    $array[$matches['search']][] = $matches['replace'];
                } elseif ($line) {
                    $this->molecule = $line;
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $output = [];

        foreach ($array as $el => $reps) {
            $len = strlen($el);
            foreach ($reps as $rep) {
                $offset = 0;
                while (false !== ($offset = strpos($this->molecule, $el, $offset))) {
                    $new = substr_replace($this->molecule, $rep, $offset, $len);
                    $output[$new] = true;
                    $offset += $len;
                }
            }
        }

        return (string)count($output);
    }

    public function exec2(array $array = []): string
    {
        $map = [];
        foreach ($array as $el => $reps) {
            foreach ($reps as $rep) {
                $map[$rep] = $el;
            }
        }

        $steps = 0;
        while ($this->molecule !== 'e') {
            foreach ($map as $el => $rep) {
                $pos = strpos($this->molecule, $el);
                if ($pos !== false) {
                    $this->molecule = substr_replace($this->molecule, $rep, $pos, strlen((string)$el));
                    $steps++;
                }
            }
        }

        return (string)$steps;
    }
}
