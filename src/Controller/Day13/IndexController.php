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
                $ids = array_filter(
                    explode(',', fgets($file)),
                    function ($el) {
                        return is_numeric($el);
                    }
                );
                
                $busses = [];
                foreach ($ids as $id) {
                    $mod = (int)$timestamp % (int)$id;
                    $remain = (int)$id - $mod;
                    $busses[] = [
                        'id' => (int)$id,
                        'remain' => $remain
                    ];
                }
                
                $array[] = [
                    'timestamp' => (int)$timestamp,
                    'busses' => $busses
                ];
            }
            fclose($file);
        }
        
        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = $array[0]['timestamp'];

        $lastId = 0;
        foreach ($array[0]['busses'] as $bus) {
            if ($bus['remain'] < $result) {
                $result = $bus['remain'];
                $lastId = $bus['id'];
            }
        }
        
        return (string)($result * $lastId);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;



        return (string)$result;
    }
}
