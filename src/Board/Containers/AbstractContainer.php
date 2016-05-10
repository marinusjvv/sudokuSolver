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
     * @var array
     */
    protected $setValues = [];

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

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param $value
     * @return bool
     */
    public function hasSetValue($value)
    {
        return in_array($value, $this->setValues);
    }

    /**
     * @return array
     */
    public function getSetValues()
    {
        return $this->setValues;
    }

    /**
     * @param integer $setValue
     */
    public function setSetValue($setValue)
    {
        $this->setValues[] = $setValue;
    }
}
