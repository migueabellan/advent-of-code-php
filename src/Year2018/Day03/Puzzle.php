<?php

namespace App\Year2018\Day03;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^#(?'id'.*) @ (?'ini'.*): (?'end'.*)$~", $line, $matches);

                $ini = array_map('intval', explode(',', $matches['ini']));
                $end = array_map('intval', explode('x', $matches['end']));

                $array[] = [
                    'id' => intval($matches['id']),
                    'x1' => $ini[0],
                    'y1' => $ini[1],
                    'x2' => $ini[0] + $end[0],
                    'y2' => $ini[1] + $end[1]
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): int
    {
        $chimney = new Chimney();

        foreach ($input as $claim) {
            $chimney->add($claim);
        }

        return $chimney->getOverlaps();
    }

    public function exec2(array $input = []): int
    {
        $chimney = new Chimney();

        foreach ($input as $claim) {
            $chimney->add($claim);
        }

        foreach ($input as $claim) {
            if (!$chimney->isOverlaps($claim)) {
                return $claim['id'];
            }
        }

        return 0;
    }
}
