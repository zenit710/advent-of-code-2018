<?php

const FILENAME = 'input.txt';

$file = fopen(FILENAME, 'r');

/**
 * @param resource $file
 */
function findCheksum($file)
{
    $twoOfLetterCount = 0;
    $threeOfLetterCount = 0;

    while (false !== $line = fgets($file)) {
        $charCountArray = countCharsInLine(str_split($line));
        $hasTwoSameChars = false;
        $hasThreeSameChars = false;

        foreach ($charCountArray as $value) {
            if ($value == 2) {
                $hasTwoSameChars = true;
            } elseif ($value == 3) {
                $hasThreeSameChars = true;
            }
        }

        if ($hasTwoSameChars) $twoOfLetterCount++;
        if ($hasThreeSameChars) $threeOfLetterCount++;
    }

    echo sprintf("TwoOfLetters: %d\n", $twoOfLetterCount);
    echo sprintf("ThreeOfLetters: %d\n", $threeOfLetterCount);
    echo sprintf("Checksum: %d\n", $twoOfLetterCount * $threeOfLetterCount);
}

/**
 * @param array $chars
 * @return array
 */
function countCharsInLine(array $chars)
{
    $charCount = [];

    foreach ($chars as $char) {
        if (array_key_exists($char, $charCount)) {
            $charCount[$char]++;
        } else {
            $charCount[$char] = 1;
        }
    }

    return $charCount;
}

/**
 * @param resource $file
 */
function printCommonLetters($file)
{
    $possibleBoxIds = [];
    $commonLetters = '';

    while (false !== $line = fgets($file)) {
        $lineChars = str_split($line);
        $lineLength = count($lineChars);
        $similarTo = null;
        $differentLetters = [];

        foreach ($possibleBoxIds as $id) {
            $idChars = str_split($id);
            $letterDiff = [];

            for ($i = 0; $i < $lineLength; $i++) {
                if ($lineChars[$i] != $idChars[$i]) {
                    $letterDiff[] = $lineChars[$i];
                    $letterDiff[] = $idChars[$i];
                }
            }

            if (count($letterDiff) == 2) {
                $similarTo = $id;
                $differentLetters = $letterDiff;
            }
        }

        if (!is_null($similarTo)) {
            $possibleBoxIds = [$similarTo];
            $commonLetters = empty($commonLetters) ? $similarTo : $commonLetters;
            $commonLetters = str_replace($differentLetters, '', $commonLetters);
        } elseif (empty($commonLetters)) {
            $possibleBoxIds[] = $line;
        }
    }

    echo sprintf("common letters: %s\n", $commonLetters);
}

findCheksum($file);
rewind($file);
printCommonLetters($file);
