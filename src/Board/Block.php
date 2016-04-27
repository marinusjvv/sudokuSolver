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
        $this->value = $value;
    }

    /**
     * @param $value
     * @throws InvalidValueException
     */
    public function setCalculatedValue($value)
    {
        if ((int)$this->value > 0 && $this->value !== $value) {
            throw new InvalidValueException();
        }
        $this->value = $value;
    }
}
