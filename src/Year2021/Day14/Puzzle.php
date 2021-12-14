<?php

namespace App\Year2021\Day14;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            if (($line = fgets($file)) !== false) {
                $array['template'] = trim($line);
            }
            while (($line = fgets($file)) !== false) {
                if (str_contains($line, ' -> ')) {
                    preg_match("~^(?'e1'.*) -> (?'e2'.*)$~", trim($line), $matches);
                    $array['rules'][$matches['e1']] = $matches['e2'];
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $polymer = new Polymer($input['template'], $input['rules']);

        $polymer->steps(10);

        return (string)$polymer->calc();
    }

    public function exec2(array $input = []): string
    {
        $polymer = new Polymer($input['template'], $input['rules']);
        
        $polymer->steps(40);

        // var_dump($polymer->getTemplate());

        return (string)$polymer->calc();
    }
}
