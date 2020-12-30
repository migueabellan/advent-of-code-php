<?php

namespace App\Year2020\Day08;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const NOP = 'nop';

    private const ACC = 'acc';

    private const JMP = 'jmp';

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'ins'.*) (?'val'.*)$~", $line, $matches);

                $array[] = [
                    'ins' => $matches['ins'],
                    'val' => (int)$matches['val'],
                    'is_exec' => false
                ];
            }
            fclose($file);
        }
        
        return $array;
    }

    // Iterative

    /*
    private function getAccumulator(array $array, int $pointer = 0): int
    {
        $result = 0;

        while ($pointer < count($array)) {
            if ($array[$pointer]['is_exec']) {
                break;
            }

            $array[$pointer]['is_exec'] = true;

            switch ($array[$pointer]['ins']) {
                case self::NOP:
                    $pointer++;
                    break;
                case self::ACC:
                    $result += $array[$pointer]['val'];
                    $pointer++;
                    break;
                case self::JMP:
                    $pointer += $array[$pointer]['val'];
                    break;
            }
        }

        return $result;
    }

    private function hasInfiniteLoop(array $array): bool
    {
        $pointer = 0;

        while ($pointer < count($array)) {
            if ($array[$pointer]['is_exec']) {
                return true;
            }

            $array[$pointer]['is_exec'] = true;

            switch ($array[$pointer]['ins']) {
                case self::NOP:
                    $pointer++;
                    break;
                case self::ACC:
                    $pointer++;
                    break;
                case self::JMP:
                    $pointer += $array[$pointer]['val'];
                    break;
            }
        }

        return false;
    }

    public function exec1(array $array = []): string
    {
        $result = $this->getAccumulator($array);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $corrupted = array_filter($array, function ($el) {
            $haystack = [self::NOP, self::JMP];
            return in_array($el['ins'], $haystack);
        });

        foreach ($corrupted as $key => $replace) {
            $candidate = $array;

            switch ($candidate[$key]['ins']) {
                case self::NOP:
                    $candidate[$key]['ins'] = self::JMP;
                    break;
                case self::JMP:
                    $candidate[$key]['ins'] = self::NOP;
                    break;
            }

            if (!$this->hasInfiniteLoop($candidate)) {
                return (string)$this->getAccumulator($candidate);
            }
        }

        return (string)$result;
    }
    */

    // Recursive

    public function getAccumulatorRecursive(array $array, int $pointer): int
    {
        if (!isset($array[$pointer]) || $array[$pointer]['is_exec']) {
            return 0;
        }

        $array[$pointer]['is_exec'] = true;

        switch ($array[$pointer]['ins']) {
            case self::NOP:
                $pointer++;
                return $this->getAccumulatorRecursive($array, $pointer);

            case self::ACC:
                $pointer++;
                return $this->getAccumulatorRecursive($array, $pointer) + $array[$pointer - 1]['val'];

            case self::JMP:
                $pointer += $array[$pointer]['val'];
                return $this->getAccumulatorRecursive($array, $pointer);
        }

        return 0;
    }

    public function hasInfiniteLoopRecursive(array $array, int $pointer): bool
    {
        if (isset($array[$pointer]) && $array[$pointer]['is_exec']) {
            return true;
        }

        $array[$pointer]['is_exec'] = true;

        if (isset($array[$pointer]['ins'])) {
            switch ($array[$pointer]['ins']) {
                case self::NOP:
                    $pointer++;
                    return $this->hasInfiniteLoopRecursive($array, $pointer);

                case self::ACC:
                    $pointer++;
                    return $this->hasInfiniteLoopRecursive($array, $pointer);

                case self::JMP:
                    $pointer += $array[$pointer]['val'];
                    return $this->hasInfiniteLoopRecursive($array, $pointer);
            }
        }

        return false;
    }

    public function exec1(array $array = []): string
    {
        $result = $this->getAccumulatorRecursive($array, 0);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;


        $corrupted = array_filter($array, function ($el) {
            $haystack = [self::NOP, self::JMP];
            return in_array($el['ins'], $haystack);
        });

        foreach ($corrupted as $key => $replace) {
            $candidate = $array;
            switch ($candidate[$key]['ins']) {
                case self::NOP:
                    $candidate[$key]['ins'] = self::JMP;
                    break;
                case self::JMP:
                    $candidate[$key]['ins'] = self::NOP;
                    break;
            }

            if (!$this->hasInfiniteLoopRecursive($candidate, 0)) {
                return (string)$this->getAccumulatorRecursive($candidate, 0);
            }
        }

        return (string)$result;
    }
}
