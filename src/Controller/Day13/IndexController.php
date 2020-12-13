<?php

namespace App\Controller\Day13;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($timestamp = fgets($file)) !== false) {
                $array['timestamp'] = (int)$timestamp;
                $array['busses'] = explode(',', (string)fgets($file));
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = $array['timestamp'];

        foreach ($array['busses'] as $bus) {
            if (is_numeric($bus)) {
                $diff = $bus - ($array['timestamp'] % $bus);
                if ($diff < $result) {
                    $result = $diff * $bus;
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;



        return (string)$result;
    }
}
