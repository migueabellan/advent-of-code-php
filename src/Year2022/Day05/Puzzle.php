<?php

namespace App\Year2022\Day05;

use App\Puzzle\AbstractPuzzle;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $characters = range('A', 'Z');
        $array = [
            'stacks' => [],
            'movements' => []
        ];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                if (!str_starts_with(trim($line), 'move')) {
                    foreach (str_split($line) as $key => $item) {
                        if (in_array($item, $characters, true)) {
                            $column = (($key - 1) / 4) + 1;
                            $array['stacks'][$column][] = $item;
                        }
                    }
                }
                if (str_starts_with(trim($line), 'move')) {
                    preg_match('/move (.*) from (.*) to (.*)/', trim($line), $matches);
                    $array['movements'][] = [
                        'qty' => intval($matches[1]),
                        'from' => intval($matches[2]),
                        'to' => intval($matches[3])
                    ];
                }
            }
        }

        ksort($array['stacks']);

        return $array;
    }

    public function exec1(array $input = []): string
    {
        $crane = new Crane($input['stacks']);

        foreach ($input['movements'] as $movements) {
            $crane->move($movements['qty'], $movements['from'], $movements['to']);
        }

        return $crane->end();
    }

    public function exec2(array $input = []): string
    {
        $crane = new Crane($input['stacks']);

        foreach ($input['movements'] as $movements) {
            $crane->move9001($movements['qty'], $movements['from'], $movements['to']);
        }

        return $crane->end();
    }
}
