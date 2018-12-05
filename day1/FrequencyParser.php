<?php

/**
 * Class FrequencyParser
 */
class FrequencyParser
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var int
     */
    private $frequency;

    /**
     * @var int
     */
    private $firstFrequencyRepeat;

    /**
     * @var array
     */
    private $frequencyHistory = [];

    /**
     * FrequencyCounter constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * @return int
     */
    public function getFirstFrequencyRepeat(): int
    {
        return $this->firstFrequencyRepeat;
    }

    public function parse()
    {
        $file = fopen('input.txt', 'r');
        $frequency = $this->findFrequency($file);
        $this->frequency = $frequency;

        while (is_null($this->firstFrequencyRepeat)) {
            rewind($file);
            $frequency = $this->findFrequency($file, $frequency);
        }
    }

    /**
     * @param resource $file
     * @param int $frequency
     * @return int
     */
    private function findFrequency($file, int $frequency = 0): int
    {
        while (false !== $line = fgets($file)) {
            $operation = substr($line, 0, 1);
            $value = intval(substr($line, 1));
            $frequency += $operation == '+' ? $value : (-$value);

            if (is_null($this->firstFrequencyRepeat)) {
                if (in_array($frequency, $this->frequencyHistory)) {
                    $this->firstFrequencyRepeat = $frequency;
                } else {
                    $this->frequencyHistory[] = $frequency;
                }
            }
        }

        return $frequency;
    }
}