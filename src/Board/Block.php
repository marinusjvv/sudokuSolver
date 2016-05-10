<?php

namespace MarinusJvv\Sudoku\Board;

use MarinusJvv\Sudoku\Board\Exceptions\InvalidValueException;

class Block
{
    /**
     * @var int
     */
    protected $value = 0;

    /**
     * @var array
     */
    protected $possibleValues = [];

    public function __construct()
    {
        $this->possibleValues = range(1, PUZZLE_SIZE);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    public function setOriginalValue($value)
    {
        $this->emptyPossibleValues();
        $this->value = $value;
    }

    /**
     * @param $value
     * @throws InvalidValueException
     */
    public function setCalculatedValue($value)
    {
        if ($this->value > 0 && $this->value !== $value) {
            throw new InvalidValueException();
        }
        $this->setOriginalValue($value);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasPossibleValue($key)
    {
        return in_array($key, $this->possibleValues);
    }

    /**
     * @param $value
     */
    public function removePossibleValue($value)
    {
        $this->possibleValues = array_diff($this->possibleValues, [$value]);
    }

    /**
     * @return bool
     */
    public function hasOnlyOnePossibleValue()
    {
        return count($this->possibleValues) === 1;
    }

    /**
     * @return array
     */
    public function getPossibleValues()
    {
        return $this->possibleValues;
    }

    /**
     * @param array $possibleValues
     */
    public function setPossibleValues($possibleValues)
    {
        $this->possibleValues = $possibleValues;
    }

    /**
     * @return void
     */
    public function emptyPossibleValues()
    {
        $this->possibleValues = [];
    }
}
