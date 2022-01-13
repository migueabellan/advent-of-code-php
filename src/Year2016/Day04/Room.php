<?php

namespace App\Year2016\Day04;

final class Room
{
    public const PHRASE = 'northpole object storage';
    
    private const ALPHABET = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g',
        'h', 'i', 'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's', 't', 'u',
        'v', 'w', 'x', 'y', 'z'
    ];

    private string $name;
    private int $id;
    private string $checksum;

    public function __construct(string $instruction)
    {
        preg_match('/^(?<name>[\w-]{0,100})-(?<id>\d+)\[(?<checksum>\w{5})\]$/', $instruction, $matches);

        $this->name = $matches['name'];
        $this->id = $matches['id'];
        $this->checksum = $matches['checksum'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIsReal(): bool
    {
        $name = str_replace('-', '', $this->name);

        $characters = array_count_values(str_split($name));

        $values = array_values($characters);
        $keys = array_keys($characters);

        array_multisort(
            $values,
            SORT_DESC,
            $keys,
            SORT_ASC,
            $characters
        );

        return $this->checksum === implode('', array_slice($keys, 0, 5));
    }

    public function getPhrase(): string
    {
        $mod = count(self::ALPHABET);

        $decrypted = '';

        foreach (str_split($this->name) as $character) {
            if ($character === '-') {
                $decrypted .= ' ';
            } else {
                $key = array_search($character, self::ALPHABET);
                $decrypted .= self::ALPHABET[($key + $this->id) % $mod];
            }
        }
        
        return $decrypted;
    }
}
