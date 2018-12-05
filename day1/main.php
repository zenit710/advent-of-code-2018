<?php

$content = fopen('input.txt', 'r');

if ($content) {
    $frequency = 0;

    while (false !== $line = fgets($content)) {
        $operation = substr($line, 0, 1);
        $value = intval(substr($line, 1));

        $frequency += $operation == '+' ? $value : (-$value);
    }

    echo $frequency;
}
