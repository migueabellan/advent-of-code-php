<?php
 
namespace App\Year2024\Day09;
 
final class Disk
{
    private int $total = 0;

    public function __construct(private array $array)
    {
        $this->total = count($array);
    }

    public function compact(): void
    {
        $freeSpaces = [];

        for ($i = 0; $i < $this->total; $i++) {
            if ($this->array[$i] === -1) {
                $freeSpaces[] = $i;
            }
        }

        $freeSpaceIndex = 0;
        for ($i = $this->total - 1; $i >= 0 && $freeSpaceIndex < count($freeSpaces); $i--) {
            if ($this->array[$i] !== -1) {
                $freeSpacePos = $freeSpaces[$freeSpaceIndex];
                if ($freeSpacePos < $i) {
                    $this->array[$freeSpacePos] = $this->array[$i];
                    $this->array[$i] = -1;
                    $freeSpaceIndex++;
                }
            }
        }
    }

    public function whole(): void
    {
        $files = [];

        for ($i = 0; $i < $this->total; $i++) {
            $fileId = $this->array[$i];
            if ($fileId !== -1) {
                if (!isset($files[$fileId])) {
                    $files[$fileId] = [
                        'id' => $fileId,
                        'start' => $i,
                        'size' => 1,
                        'blocks' => [$i],
                    ];
                } else {
                    $files[$fileId]['size']++;
                    $files[$fileId]['blocks'][] = $i;
                }
            }
        }

        krsort($files);
        foreach ($files as $file) {
            $bestPosition = $this->findBestFitPosition($file['start'], $file['size']);
            if ($bestPosition !== -1 && $bestPosition < $file['start']) {
                foreach ($file['blocks'] as $index => $oldPos) {
                    $newPos = $bestPosition + $index;
                    $this->array[$newPos] = $file['id'];
                    $this->array[$oldPos] = -1;
                }
            }
        }
    }

    private function findBestFitPosition(int $currentStart, int $size): int
    {
        $consecutiveFreeSpace = 0;
        $startPosition = -1;

        for ($i = 0; $i < $currentStart; $i++) {
            if ($this->array[$i] === -1) {
                if ($consecutiveFreeSpace === 0) {
                    $startPosition = $i;
                }
                $consecutiveFreeSpace++;
                if ($consecutiveFreeSpace >= $size) {
                    return $startPosition;
                }
            } else {
                $consecutiveFreeSpace = 0;
                $startPosition = -1;
            }
        }

        return -1;
    }

    public function checksum(): int
    {
        $checksum = 0;

        foreach ($this->array as $i => $id) {
            if ($id !== -1) {
                $checksum += $i * $id;
            }
        }

        return $checksum;
    }
}
