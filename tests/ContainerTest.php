<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Block;
use MarinusJvv\Sudoku\Board\Containers\Row;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBlockByPosition()
    {
        $position = 3;
        $value = 5;
        $block = new Block();
        $block->setCalculatedValue($value);
        $row = new Row();
        $row->setBlock($position, $block);
        $this->assertEquals($value, $row->getBlock($position)->getValue());
    }

    public function testGetBlocks_ReturnsBlocksByReference()
    {
        $row = new Row();
        for ($i=1; $i<=PUZZLE_SIZE; $i++) {
            $block = new Block();
            $row->setBlock($i, $block);
        }

        $blocks = $row->getBlocks();
        /** @var Block $block */
        $val = 9;
        foreach ($blocks as $block) {
            $block->setCalculatedValue($val--);
        }

        $blocks = $row->getBlocks();
        /** @var Block $block */
        $val = 9;
        foreach ($blocks as $block) {
            $this->assertEquals($val--, $block->getValue());
        }
    }
}
