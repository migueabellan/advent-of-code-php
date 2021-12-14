<?php

namespace App\Year2021\Day14;

class Polymer
{
    private string $template;
    private array $rules = [];

    private array $letters = [];
    private array $pairs = [];

    public function __construct(string $template, array $rules)
    {
        $this->template = $template;
        $this->rules = $rules;

        foreach (str_split($template) as $letter) {
            if (!isset($this->letters[$letter])) {
                $this->letters[$letter] = 0;
            }
            $this->letters[$letter]++;
        }

        $this->pairs = array_map(fn () => 0, $this->rules);
        for ($i = 1; $i < strlen($this->template); $i++) {
            $this->pairs[$this->template[$i - 1] . $this->template[$i]]++;
        }
    }

    // First Algorithm
    /*
    public function steps(int $steps): void
    {
        for ($i = 0; $i < $steps; $i++) {
            $result = [];

            $template = $this->template;

            while (mb_strlen($template) > 1) {
                array_pop($result);

                $rule = substr($template, 0, 2);

                array_push($result, str_split($rule)[0], $this->rules[$rule], str_split($rule)[1]);

                $template = substr($template, 1);
            }

            $this->template = implode($result);
        }
    }
    */

    public function steps(int $steps): void
    {
        for ($i = 0; $i < $steps; $i++) {
            $result = array_map(fn () => 0, $this->rules);

            foreach ($this->pairs as $pair => $value) {
                $letter = $this->rules[$pair];
                $this->letters[$letter] += $value;

                $result[$pair[0] . $letter] += $value;
                $result[$letter . $pair[1]] += $value;
            }

            $this->pairs = $result;
        }
    }

    public function calc(): int
    {
        asort($this->letters);

        return end($this->letters) - reset($this->letters);
    }
}
