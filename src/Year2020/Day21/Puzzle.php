<?php

namespace App\Year2020\Day21;

use App\Puzzle\AbstractPuzzle;
use stdClass;

class Puzzle extends AbstractPuzzle
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);

                preg_match("~^(?'ingredients'.*) \(contains (?'allergens'.*)\)$~", $line, $matches);

                $food = new stdClass;
                $food->ingredients = explode(' ', $matches['ingredients']);
                $food->allergens = explode(',', str_replace(' ', '', $matches['allergens']));

                $array[] = $food;
            }
            fclose($file);
        }

        return $array;
    }

    protected function getAllergens(array $foods): array
    {
        $allergens = [];

        $possibleIngredients = [];

        $foundIngredients = [];

        foreach ($foods as $food) {
            foreach ($food->allergens as $allergen) {
                $currentPossibleIngredients = $possibleIngredients[$allergen] ?? null;
                $newPossibleIngredients = [];
                foreach ($food->ingredients as $ingredient) {
                    $newPossibleIngredients[] = $ingredient;

                    if (is_null($currentPossibleIngredients)) {
                        $possibleIngredients[$allergen] = $newPossibleIngredients;
                    } else {
                        $possibleIngredients[$allergen] =
                            array_intersect($currentPossibleIngredients, $newPossibleIngredients);
                    }
                }

                if (count($possibleIngredients[$allergen]) === 1) {
                    $ingredient = current($possibleIngredients[$allergen]);
                    $foundIngredients[] = $ingredient;
                    $allergens[$ingredient] = $allergen;
                }
            }
        }

        while (count($foundIngredients)) {
            $newFoundIngredients = [];
            foreach ($possibleIngredients as $allergen => $ingredients) {
                foreach ($foundIngredients as $foundIngredient) {
                    if (($key = array_search($foundIngredient, $ingredients)) !== false) {
                        unset($possibleIngredients[$allergen][$key]);
                    }
                    if (count($possibleIngredients[$allergen]) === 1) {
                        $ingredient = current($possibleIngredients[$allergen]);
                        $newFoundIngredients[] = $ingredient;
                        $allergens[$ingredient] = $allergen;
                    }
                }
            }
            $foundIngredients = $newFoundIngredients;
        }

        return $allergens;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        $allergens = $this->getAllergens($array);

        $ingredientAmounts = [];
        foreach ($array as $food) {
            foreach ($food->ingredients as $ingredient) {
                if (!isset($ingredientAmounts[$ingredient])) {
                    $ingredientAmounts[$ingredient] = 1;
                } else {
                    $ingredientAmounts[$ingredient]++;
                }
            }
        }

        foreach ($ingredientAmounts as $ingredient => $amount) {
            if (!isset($allergens[$ingredient])) {
                $result += $amount;
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $allergens = $this->getAllergens($array);

        asort($allergens);

        return implode(',', array_keys($allergens));
    }
}
