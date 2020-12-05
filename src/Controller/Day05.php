<?php

namespace App\Controller;

use App\AbstractController;

class Day05 extends AbstractController
{
    public function exec1(): void
    {
        $array = $this->read();

        $result = 0;

        foreach ($array as $seat) {
            $row = mb_strcut($seat, 0, 7);
            $row = str_replace('F', 0, $row);
            $row = str_replace('B', 1, $row);
            $num_row = bindec(mb_strcut($row, 0, 7));

            $col = mb_strcut($seat, 7, 10);
            $col = str_replace('L', 0, $col);
            $col = str_replace('R', 1, $col);
            $num_col = bindec(mb_strcut($col, 0, 7));

            $id = ($num_row * 8) + $num_col;

            if ($id > $result) {
                $result = $id;
            }
        }

        $this->write((string)$result);
    }

    public function exec2(): void
    {
        $array = $this->read();

        $result = [];
        
        foreach ($array as $seat) {
            $row = mb_strcut($seat, 0, 7);
            $row = str_replace('F', 0, $row);
            $row = str_replace('B', 1, $row);
            $num_row = bindec(mb_strcut($row, 0, 7));

            $col = mb_strcut($seat, 7, 10);
            $col = str_replace('L', 0, $col);
            $col = str_replace('R', 1, $col);
            $num_col = bindec(mb_strcut($col, 0, 7));

            $id = ($num_row * 8) + $num_col;

            $result[] = $id;
        }

        sort($result);

        $myseat = 0;
        foreach ($result as $k => $seat) {
            if ($result[$k] + 2 === $result[$k + 1]) {
                $myseat = $seat + 1;
            }
        }

        $this->write((string)$myseat);
    }
}
