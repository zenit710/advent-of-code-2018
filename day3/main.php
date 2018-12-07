<?php

const FILENAME = 'input.txt';

$file = fopen(FILENAME, 'r');

countSharedInches($file);

function countSharedInches($file)
{
    $matrix = [];
    $sharedInches = [];
    $sharedInchesCount = 0;

    while (false !== $line = fgets($file)) {
        $line = str_replace(' @', '', $line);
        $line = str_replace(':', '', $line);

        list($id, $position, $size) = explode(' ', $line);
        list($column, $row) = explode(',', $position);
        list($width, $height) = explode('x', $size);
        $endColumn = $column + $width;
        $endRow = $row + $height;
        echo $id . PHP_EOL;

        for ($i = $column; $i < $endColumn; $i++) {
            for ($j = $column; $j < $endRow; $j++) {
                if (isset($matrix[$i])) {
                    if (isset($matrix[$i][$j])) {
                        $matrix[$i][$j] = 'X';
                        $coord = "$i:$j";

                        if (!in_array($coord, $sharedInches)) {
                            $sharedInches[] = $coord;
                            $sharedInchesCount++;
                        }
                    } else {
                        $matrix[$i][$j] = $id;
                    }
                } else {
                    $matrix[$i] = [];
                    $matrix[$i][$j] = $id;
                }
            }
        }
    }

    echo sprintf("Shared inches: %d\n", $sharedInchesCount);
}