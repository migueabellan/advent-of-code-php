<?php

namespace App\Controller\Day25;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const VALUE = 20201227;
    private const SUBJECT = 7;

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                $array[] = (int)$line;
            }
            fclose($file);
        }

        return $array;
    }

    private function findLoopSize(int $key): int
    {
        $result = 0;

        $value = 1;
        while ($key !== $value) {
            $result++;
            $value *= self::SUBJECT;
            $value %= self::VALUE;
        }

        return $result;
    }

    private function transformNumber(int $subjectNumber, int $loopSize): int
    {
        $result = 1;

        for ($i = 0; $i < $loopSize; $i++) {
            $result *= $subjectNumber;
            $result %= self::VALUE;
        }

        return $result;
    }

    public function exec1(array $array = []): string
    {
        $cardSubjectNumber = $array[0];
        $doorSubjectNumber = $array[1];

        $doorLoopSize = $this->findLoopSize($doorSubjectNumber);

        $result = $this->transformNumber($cardSubjectNumber, $doorLoopSize);

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        return (string)$result;
    }
}
