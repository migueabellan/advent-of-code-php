<?php

namespace App\Controller\Day07;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const BAG = 'shiny gold';

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                preg_match("~^(?'bag'.*) bags contain (?'contain'.*).$~", $line, $matches);
                $bag = $matches['bag'];
                $contain = $matches['contain'];

                preg_match_all("~(?'count'\d+) (?'bag'.*) bag(?>s?)~U", $contain, $matches, PREG_SET_ORDER);

                $array[$bag] = [];
                foreach ($matches as $rule) {
                    $array[$bag][$rule['bag']] = $rule['count'];
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function findParentBy(array $array, string $search): array
    {
        $bags = [];

        foreach ($array as $key => $value) {
            if (in_array($search, array_keys($value))) {
                $bags[] = $key;
                $bags = array_unique(array_merge($bags, $this->findParentBy($array, $key)));
            }
        }

        return $bags;
    }

    public function exec1(array $array = []): string
    {
        $bags = $this->findParentBy($array, self::BAG);

        return (string)count($bags);
    }


    public function countBags(array $array, array $children): int
    {
        $count = 0;

        foreach ($children as $key => $value) {
            $sum = $this->countBags($array, $array[$key]);
            $count += $value + ($value * $sum);
        }

        return $count;
    }

    public function exec2(array $array = []): string
    {
        $result = $this->countBags($array, $array[self::BAG]);

        return (string)$result;
    }
}
