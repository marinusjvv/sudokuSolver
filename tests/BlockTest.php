<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Block;

class BlockTest extends \PHPUnit_Framework_TestCase
{
    public function testSetOriginalValue()
    {
        $value = 5;
        $block = new Block();
        $block->setOriginalValue($value);
        $this->assertEquals($value, $block->getValue());
    }

    public function testSetCalculatedValue()
    {
        $value = 5;
        $block = new Block();
        $block->setCalculatedValue($value);
        $this->assertEquals($value, $block->getValue());
    }

    /**
     * @expectedException MarinusJvv\Sudoku\Board\Exceptions\InvalidValueException
     */
    public function testSetCalculatedValue_InvalidValue_ThrowsException()
    {
        $value = 5;
        $block = new Block();
        $block->setCalculatedValue($value);
        $block->setCalculatedValue(++$value);
    }
}
