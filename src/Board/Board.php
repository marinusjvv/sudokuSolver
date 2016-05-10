<?php

namespace MarinusJvv\Sudoku\Board;

use MarinusJvv\Sudoku\Board\Containers\Column;
use MarinusJvv\Sudoku\Board\Containers\Row;
use MarinusJvv\Sudoku\Board\Containers\Section;
use MarinusJvv\Sudoku\Board\Utilities\SectionPositionCalculator;

class Board
{
    /**
     * @var array
     */
    protected $rows = [];
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var array
     */
    protected $sections = [];
    /**
     * @var array
     */
    protected $blocks = [];

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->setupBoard();
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param $position
     * @return Row
     */
    public function getRow($position)
    {
        return $this->rows[$position];
    }

    /**
     * @param $position
     * @return Column
     */
    public function getColumn($position)
    {
        return $this->columns[$position];
    }

    /**
     * @param $position
     * @return Section
     */
    public function getSection($position)
    {
        return $this->sections[$position];
    }

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @return void
     */
    protected function setupBoard()
    {
        $this->buildContainers();
        $this->buildBlocks();
    }

    /**
     * @return int
     */
    protected function buildContainers()
    {
        for ($i = 1; $i <= PUZZLE_SIZE; $i++) {
            $this->rows[$i] = new Row();
            $this->columns[$i] = new Column();
            $this->sections[$i] = new Section();
        }
    }

    /**
     * @return void
     */
    protected function buildBlocks()
    {
        for ($row = 1; $row <= PUZZLE_SIZE; $row++) {
            for ($column = 1; $column <= PUZZLE_SIZE; $column++) {
                $block = new Block();
                $this->blocks[] = $block;
                $this->getRow($row)->setBlock($column, $block);
                $this->getColumn($column)->setBlock($row, $block);
                $sectionNumber = SectionPositionCalculator::getSectionPosition($column, $row);
                $sectionBlockNumber = SectionPositionCalculator::getSectionBlockPosition($column, $row);
                $this->getSection($sectionNumber)->setBlock($sectionBlockNumber, $block);
            }
        }
    }

    /**
     * @param $row
     * @param $position
     * @param $value
     * @throws Exceptions\InvalidValueException
     */
    public function setValueByRow($row, $position, $value)
    {
        $this->getRow($row)->getBlock($position)->setCalculatedValue($value);
    }
}
