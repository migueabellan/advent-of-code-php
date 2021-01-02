<?php

namespace App\Year2015\Day04;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function exec1(array $input = []): string
    {
        $secret = current($input);

        $i = 0;
        do {
            $i++;
        } while (!str_starts_with(md5($secret.$i), '00000'));

        return (string)$i;
    }

    public function exec2(array $input = []): string
    {
        $secret = current($input);

        $i = 0;
        do {
            $i++;
        } while (!str_starts_with(md5($secret.$i), '000000'));

        return (string)$i;
    }
}
