<?php

namespace Tests\Utils;

use App\Utils\ArrayUtil;
use PHPUnit\Framework\TestCase;

class ArrayUtilTest extends TestCase
{
    /**
     * @dataProvider permutations
     */
    public function testPermutations(array $array, array $expected): void
    {
        $permutations = ArrayUtil::permutations($array);

        $this->assertEquals($permutations, $expected);
    }

    public function permutations(): \Iterator
    {
        yield [
            [0, 1, 2],
            [
                [0, 1, 2],
                [1, 0, 2],
                [0, 2, 1],
                [2, 0, 1],
                [1, 2, 0],
                [2, 1, 0],
            ]
        ];
    }

    /**
     * @dataProvider combinations
     */
    public function testCombinations(array $array, array $expected): void
    {
        $combinations = ArrayUtil::combinations($array);

        $this->assertEquals($combinations, $expected);
    }

    public function combinations(): \Iterator
    {
        yield [
            [0, 1, 2],
            [
                [],
                [0],
                [1],
                [1, 0],
                [2],
                [2, 0],
                [2, 1],
                [2, 1, 0]
            ]
        ];
    }
}
