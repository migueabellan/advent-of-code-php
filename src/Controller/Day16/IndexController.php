<?php

namespace App\Controller\Day16;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];
        $array['values'] = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if ($line !== '') {
                    preg_match("~^(?'first'.*):(?'second'.*)$~", $line, $matches);
                    switch ($matches['first']) {
                        case 'your ticket':
                            $ticket = fgets($file);
                            $array['your tickets'] = array_map('intval', explode(',', (string)$ticket));
                            break;
                        case 'nearby tickets':
                            $tickets = [];
                            while (($ticket = fgets($file)) !== false) {
                                $tickets[] = array_map('intval', explode(',', $ticket));
                            }
                            $array['nearby tickets'] = $tickets;
                            break;
                        default:
                            preg_match(
                                "~^(?'min1'.*)-(?'max1'.*) or (?'min2'.*)-(?'max2'.*)$~",
                                trim($matches['second']),
                                $ors
                            );
                            $array['values'] = array_merge(
                                $array['values'],
                                range((int)$ors['min1'], (int)$ors['max1']),
                                range((int)$ors['min2'], (int)$ors['max2']),
                            );
                    }
                }
            }
            fclose($file);
        }

        return $array;
    }

    public function exec1(array $array = []): string
    {
        $result = 0;

        foreach ($array['nearby tickets'] as $ticket) {
            foreach ($ticket as $number) {
                if (!in_array($number, $array['values'])) {
                    $result += $number;
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        //

        return (string)$result;
    }
}
