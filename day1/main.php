<?php

$content = fopen('input.txt', 'r');

if ($content) {
    $frequency = 0;
    $frequencyHistory = array(0);
    $firstRepeatOfFrequency = null;

    while (false !== $line = fgets($content)) {
        $operation = substr($line, 0, 1);
        $value = intval(substr($line, 1));

        $frequency += $operation == '+' ? $value : (-$value);

        if (is_null($firstRepeatOfFrequency)) {
            if (in_array($frequency, $frequencyHistory)) {
                $firstRepeatOfFrequency = $frequency;
            } else {
                $frequencyHistory[] = $frequency;
            }
        }
    }

    echo sprintf('Frequency: %d', $frequency);

    if (!is_null($firstRepeatOfFrequency)) {
        echo sprintf('First repeat of frequency: %d', $firstRepeatOfFrequency);
    }
}
