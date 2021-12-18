<?php

namespace App\Year2021\Day16;

class Packet
{
    const TYPE_LITERAL = 4;

    private string $binary;
    public int $length = 0;

    public int $version;
    public int $typeId;

    private int $versionSum = 0;
    private int $value = 0;

    public function __construct(string $binary)
    {
        $this->binary = $binary;
        $this->length = strlen($binary);

        $this->version = intval(bindec(substr($binary, 0, 3)));
        $this->typeId = intval(bindec(substr($binary, 3, 3)));

        $this->unpack($binary);

        $this->versionSum += intval($this->version);
    }

    public function getVersionSum(): int
    {
        return $this->versionSum;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    private function unpack(string $binary)
    {
        if ($this->typeId === static::TYPE_LITERAL) {
            $value = '';
            $start = 6;
            while (substr($binary, $start, 1) === '1') {
                $value .= substr($binary, $start + 1, 4);
                $start += 5;
            }
            $value .= substr($binary, $start + 1, 4);

            $this->length = $start + 5;
            $this->binary = substr($this->binary, 0, $this->length);
            $this->value = intval(bindec($value));

            return $this->value;
        }

        return $this->getSubpackets($binary);
    }

    private function getSubpackets(string $binary): array
    {
        $this->length = 7;

        $values = [];

        $subpackets = [];
        $lengthTypeId = substr($binary, 6, 1);

        if ($lengthTypeId === '0') {
            $length = intval(bindec(substr($binary, 7, 15)));

            $start = 22;
            while ($start < $length + $start) {
                $payload = substr($binary, $start, $length);

                $packet = new Packet($payload);
                $subpackets[] = $packet;

                $start += $packet->length;
                $length -= $packet->length;

                $this->length += $packet->length;
                $this->versionSum += $packet->versionSum;

                $values[] = $packet->value;
            }

            $this->length += 15;
        } else {
            $count = bindec(substr($binary, 7, 11));

            $start = 18;
            for ($n = 1; $n <= $count; $n++) {
                $payload = substr($binary, $start);

                $packet = new Packet($payload);
                $subpackets[] = $packet;

                $start += $packet->length;

                $this->length += $packet->length;
                $this->versionSum += $packet->versionSum;

                $values[] = $packet->value;
            }

            $this->length += 11;
        }

        switch ($this->typeId) {
            case 0:
                $this->value = intval(array_sum($values));
                break;
            case 1:
                $this->value = intval(array_product($values));
                break;
            case 2:
                $this->value = intval(min($values));
                break;
            case 3:
                $this->value = intval(max($values));
                break;
            case 5:
                $this->value = $values[0] > $values[1] ? 1 : 0;
                break;
            case 6:
                $this->value = $values[0] < $values[1] ? 1 : 0;
                break;
            case 7:
                $this->value = $values[0] == $values[1] ? 1 : 0;
                break;
        }

        return $subpackets;
    }
}
