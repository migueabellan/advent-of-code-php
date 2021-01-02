<?php

namespace App\Year2015\Day04;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function exec1(array $input = []): string
    {
        $secret = current($input);

        $result = 0;
        $i = 0;
        while (true) {
            if (str_starts_with(md5($secret.$i), '00000')) {
                $result = $i;
                break;
            }
            $i++;
        }

        return (string)$result;
    }

    public function exec2(array $input = []): string
    {
        $secret = current($input);

        $result = 0;
        $i = 0;
        while (true) {
            if (str_starts_with(md5($secret.$i), '000000')) {
                $result = $i;
                break;
            }
            $i++;
        }

        return (string)$result;
    }
}
