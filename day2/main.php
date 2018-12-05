<?php

const FILENAME = 'input.txt';

$file = fopen(FILENAME, 'r');
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

function countCharsInLine($chars) {
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