<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Board\Utilities\SectionPositionCalculator;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testBoardHasNecessaryParts()
    {
        $board = new Board();
        $this->assertEquals(PUZZLE_SIZE, count($board->getRows()));
        $this->assertEquals(PUZZLE_SIZE, count($board->getColumns()));
        $this->assertEquals(PUZZLE_SIZE, count($board->getSections()));
        $this->assertEquals(PUZZLE_SIZE * PUZZLE_SIZE, count($board->getBlocks()));
    }

    /**
     * @dataProvider blockAssignedProvider
     * @param $rowPosition
     * @param $columnPosition
     * @param $val
     */
    public function testBlocksCorrectlyAssignedToPositions($rowPosition, $columnPosition, $val)
    {
        $board = new Board();
        $board->getRow($rowPosition)->getBlock($columnPosition)->setOriginalValue($val);

        $this->assertEquals($val, $board->getRow($rowPosition)->getBlock($columnPosition)->getValue());
        $this->assertEquals($val, $board->getColumn($columnPosition)->getBlock($rowPosition)->getValue());
        $this->assertEquals(
            $val,
            $board->getSection(SectionPositionCalculator::getSectionPosition($columnPosition, $rowPosition))->getBlock(SectionPositionCalculator::getSectionBlockPosition($columnPosition, $rowPosition))->getValue()
        );
    }

    public function blockAssignedProvider()
    {
        return [
            [4, 5, 5],
            [1, 1, 7],
            [9, 9, 9],
            [5, 5, 3],
        ];
    }

    public function testSetValueByRow()
    {
        $row = 5;
        $position = 3;
        $value = 4;
        $board = new Board();
        $board->setValueByRow($row, $position, $value);

        $this->assertEquals($value, $board->getColumn($position)->getBlock($row)->getValue());
    }
}
