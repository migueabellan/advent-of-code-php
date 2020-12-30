<?php

namespace App\Year2020\Day06;

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
            $group = 0;
            $people = 1;
            $uniques = [];
            $answers = [];
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (empty($line)) {
                    $group++;
                    $people = 1;
                    $uniques = [];
                    $answers = [];
                    continue;
                }

                $uniques = array_unique(array_merge($uniques, str_split($line)));
                $answers[] = str_split($line);

                $array[$group] = [
                    'people' => $people++,
                    'uniques' => $uniques,
                    'answers' => $answers
                ];
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array as $group) {
            $result += count($group['uniques']);
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        foreach ($array as $group) {
            $intersect = $group['uniques'];
            foreach ($group['answers'] as $answer) {
                $intersect = array_intersect($intersect, $answer);
            }
            $result += count($intersect);
        }

        return (string)$result;
    }
}
