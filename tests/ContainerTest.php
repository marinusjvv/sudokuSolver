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
}
