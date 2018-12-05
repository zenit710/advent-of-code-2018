<?php

require_once 'FrequencyParser.php';

$parser = new FrequencyParser('input.txt');
$parser->parse();

echo sprintf("Frequency: %d\n", $parser->getFrequency());
echo sprintf("First repeat of frequency: %d", $parser->getFirstFrequencyRepeat());