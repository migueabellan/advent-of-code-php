<?php
 
namespace App\Year2024\Day07;
 
final class Bridge
{
    private int $result;
    private array $numbers;
 
    public function __construct(private string $line)
    {
        [$result, $values] = explode(':', $line);
 
        $this->result = intval($result);
        $this->numbers = array_map('intval', explode(' ', trim($values)));
    }
 
    public function line(): string
    {
        return $this->line;
    }
 
    public function result(): int
    {
        return $this->result;
    }
 
    public function isValid(array $operators): bool
    {
        $permutation = array_fill(0, count($this->numbers) - 1, '+');
 
        $i = 0;
        while (true) {
            $bin = base_convert((string)$i, 10, count($operators));
            if (strlen($bin) > count($this->numbers)-1) {
                return false;
            }
 
            $bin = str_pad($bin, count($this->numbers) - 1, '0', STR_PAD_LEFT);
            $permutation = str_split(str_replace(range(0, count($operators)), $operators, $bin));
 
            $count = $this->numbers[0];
            for ($k = 1; $k < count($this->numbers); $k++) {
                $op = $permutation[$k - 1];
                $v = $this->numbers[$k];
                switch ($op) {
                    case '+':
                        $count += $v;
                        break;
                    case '*':
                        $count *= $v;
                        break;
                    case '|':
                        $count .= $v;
                        break;
                }
            }
 
            if (intval($count) === $this->result) {
                return true;
            }
 
            $i++;
        }
    }
}
