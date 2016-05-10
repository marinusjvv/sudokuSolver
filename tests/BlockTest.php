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

    public function testRemovePossibleValue()
    {
        $block = new Block();
        $this->assertTrue($block->hasPossibleValue(5));
        $this->assertTrue($block->hasPossibleValue(4));
        $block->removePossibleValue(5);
        $this->assertFalse($block->hasPossibleValue(5));
        $this->assertTrue($block->hasPossibleValue(4));
        $block->removePossibleValue(4);
        $this->assertFalse($block->hasPossibleValue(5));
        $this->assertFalse($block->hasPossibleValue(4));
    }

    public function testHasOnlyOnePossibleValue()
    {
        $block = new Block();
        for ($i=1; $i<PUZZLE_SIZE; $i++) {
            $block->removePossibleValue($i);
        }
        $this->assertTrue($block->hasOnlyOnePossibleValue());
        $array = $block->getPossibleValues();
        $this->assertEquals(PUZZLE_SIZE, array_pop($array));
    }
}
