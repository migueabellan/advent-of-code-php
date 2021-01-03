<?php

namespace App\Year2015\Day07;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const AND = 'AND';
    private const OR = 'OR';
    private const LSHIFT = 'LSHIFT';
    private const RSHIFT = 'RSHIFT';
    private const NOT = 'NOT';

    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'left'.*) -> (?'var'.*)$~", $line, $matches);

                if (preg_match("~^(?'w1'.*) (?'op'.*) (?'w2'.*)$~", $matches['left'], $left)) {
                    $array[$matches['var']] = [
                        'w1' => $left['w1'],
                        'op' => $left['op'],
                        'w2' => $left['w2'],
                        'result' => null
                    ];
                } elseif (preg_match("~^(?'op'.*) (?'w1'.*)$~", $matches['left'], $left)) {
                    $array[$matches['var']] = [
                        'op' => $left['op'],
                        'w1' => $left['w1'],
                        'result' => null
                    ];
                } elseif (preg_match("~^(?'result'.*)$~", $matches['left'], $left)) {
                    if (is_numeric($left['result'])) {
                        $array[$matches['var']] = [
                            'result' => (int)$left['result']
                        ];
                    } else {
                        $array[$matches['var']] = [
                            'op' => null,
                            'w1' => $left['result'],
                            'result' => null
                        ];
                    }
                }
            }
            fclose($file);
        }

        return $array;
    }

    private function recursive(array &$array, string $search): int
    {
        if (is_numeric($search)) {
            return (int)$search;
        }

        if (is_numeric($array[$search]['result'])) {
            return (int)$array[$search]['result'];
        }

        $v = $array[$search];

        switch ($v['op']) {
            case self::AND:
                $w1 = $this->recursive($array, $v['w1']);
                $w2 = $this->recursive($array, $v['w2']);
                $array[$search]['result'] = $w1 & $w2;
                break;
            case self::OR:
                $w1 = $this->recursive($array, $v['w1']);
                $w2 = $this->recursive($array, $v['w2']);
                $array[$search]['result'] = $w1 | $w2;
                break;
            case self::LSHIFT:
                $w1 = $this->recursive($array, $v['w1']);
                $array[$search]['result'] = $w1 << $v['w2'];
                break;
            case self::RSHIFT:
                $w1 = $this->recursive($array, $v['w1']);
                $array[$search]['result'] = $w1 >> $v['w2'];
                break;
            case self::NOT:
                $w1 = $this->recursive($array, $v['w1']);
                $array[$search]['result'] = 65535 - $w1;
                break;
            default:
                $w1 = $this->recursive($array, $v['w1']);
                $array[$search]['result'] = $w1;
                break;
        }

        return $array[$search]['result'];
    }

    public function exec1(array $array = []): string
    {
        $search = 'a';

        return (string)$this->recursive($array, $search);
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
