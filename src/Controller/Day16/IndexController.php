<?php

namespace App\Controller\Day16;

use App\Controller\AbstractController;

class IndexController extends AbstractController
{
    private const YOUR_TICKET = 'your ticket';
    private const NEARBY_TICKET = 'nearby tickets';

    private const VALUES = 'values';
    private const POSITIONS = 'positions';

    /**
     * @see AbstractController
     */
    public function read(): array
    {
        $array = [];
        $array[self::VALUES] = [];

        if ($file = fopen($this->getPathIn(), 'r')) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if ($line !== '') {
                    preg_match("~^(?'first'.*):(?'second'.*)$~", $line, $matches);
                    switch ($matches['first']) {
                        case self::YOUR_TICKET:
                            $ticket = fgets($file);
                            $array[self::YOUR_TICKET] = array_map('intval', explode(',', (string)$ticket));
                            break;
                        case self::NEARBY_TICKET:
                            $tickets = [];
                            while (($ticket = fgets($file)) !== false) {
                                $tickets[] = array_map('intval', explode(',', $ticket));
                            }
                            $array[self::NEARBY_TICKET] = $tickets;
                            break;
                        default:
                            preg_match(
                                "~^(?'min1'.*)-(?'max1'.*) or (?'min2'.*)-(?'max2'.*)$~",
                                trim($matches['second']),
                                $ors
                            );
                            $array[self::VALUES] = array_merge(
                                $array[self::VALUES],
                                range((int)$ors['min1'], (int)$ors['max1']),
                                range((int)$ors['min2'], (int)$ors['max2']),
                            );
                            $array[self::POSITIONS][$matches['first']] = array_merge(
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

        foreach ($array[self::NEARBY_TICKET] as $ticket) {
            foreach ($ticket as $number) {
                if (!in_array($number, $array[self::VALUES])) {
                    $result += $number;
                }
            }
        }

        return (string)$result;
    }

    public function exec2(array $array = []): string
    {
        $result = 0;

        $valids = [];
        foreach ($array[self::NEARBY_TICKET] as $ticket) {
            $is_valid = true;
            foreach ($ticket as $number) {
                if (!in_array($number, $array[self::VALUES])) {
                    $is_valid = false;
                }
            }
            if ($is_valid) {
                $valids[] = $ticket;
            }
        }



        // print_r($valids);
        // die;

        return (string)$result;
    }
}
