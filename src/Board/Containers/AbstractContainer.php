<?php

namespace MarinusJvv\Sudoku\Board\Containers;

use MarinusJvv\Sudoku\Board\Block;

class AbstractContainer
{
    /**
     * @var array
     */
    protected $blocks = [];

    /**
     * @param $position
     * @param Block $block
     */
    public function setBlock($position, Block $block)
    {
        $this->blocks[$position] = $block;
    }

    /**
     * @param $position
     * @return Block
     */
    public function getBlock($position)
    {
        return $this->blocks[$position];
    }
}
