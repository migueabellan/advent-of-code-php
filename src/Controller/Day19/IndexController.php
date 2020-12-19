<?php

namespace App\Controller\Day19;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private array $messages = [];

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);

                if (preg_match("~^(?'k'.*): (?'expr'.*)$~", $line, $matches)) {
                    $expr = $matches['expr'];
                    if (preg_match("~^(?'first'.*) | (?'second'.*)$~", $matches['expr'], $submatches)) {
                        $expr = $matches['expr'];
                    }

                    $array[$matches['k']] = explode(' ', str_replace('"', '', $expr));
                }

                if (preg_match('/^[a-z]+$/', $line)) {
                    $this->messages[] = $line;
                }
            }
            fclose($file);
        }

        return $array;
    }

    private function setRegex1(array $array, int $rule_id): string
    {
        $current = current($array[$rule_id]);
        if ($current === 'a' || $current === 'b') {
            return $current;
        }

        $expr = '(';
        foreach ($array[$rule_id] as $v) {
            if ($v !== '|') {
                $expr .= $this->setRegex1($array, $v);
            } else {
                $expr .= '|';
            }
        }
        $expr .= ')';

        return $expr;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        $regex = $this->setRegex1($array, 0);

        foreach ($this->messages as $message) {
            if (preg_match('/^'.$regex.'$/', $message)) {
                $result++;
            }
        }

        return (string)$result;
    }
    

    private function setRegex2(array $array, int $rule_id): string
    {
        $current = current($array[$rule_id]);
        if ($current === 'a' || $current === 'b') {
            return $current;
        }

        if ($rule_id === 8) {
            return '(' . $this->setRegex2($array, 42) . ')+';
        }

        if ($rule_id === 11) {
            return '(' . $this->setRegex2($array, 42) .'){x}(' . $this->setRegex2($array, 31) . '){x}';
        }

        $expr = '(';
        foreach ($array[$rule_id] as $v) {
            if ($v !== '|') {
                $expr .= $this->setRegex2($array, $v);
            } else {
                $expr .= '|';
            }
        }
        $expr .= ')';

        return $expr;
    }

    public function exec2(array $array = []): string
    {
        $regex = $this->setRegex2($array, 0);

        $valids = [];

        $result = -1;

        for ($x = 1; count($valids) !== $result; $x++) {
            $result = count($valids);
            foreach ($this->messages as $k => $message) {
                if (preg_match('/^'.str_replace('x', (string)$x, $regex).'$/', $message)) {
                    $valids[] = $k;
                }
            }
        }

        return (string)$result;
    }
}
