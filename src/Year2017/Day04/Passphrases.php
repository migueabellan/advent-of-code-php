<?php

namespace App\Year2017\Day04;

final class Passphrases
{
    public function __construct(
        private array $passphrases
    ) {
    }

    public function sort(): void
    {
        for ($i = 0; $i < count($this->passphrases); $i++) {
            $letters = str_split($this->passphrases[$i]);

            sort($letters);

            $this->passphrases[$i] = implode($letters);
        }
    }

    public function getIsValid(): bool
    {
        $num_passphrases = count($this->passphrases);

        for ($i = 0; $i < $num_passphrases - 1; $i++) {
            for ($j = $i + 1; $j < $num_passphrases; $j++) {
                if ($this->passphrases[$i] === $this->passphrases[$j]) {
                    return false;
                }
            }
        }

        return true;
    }
}
