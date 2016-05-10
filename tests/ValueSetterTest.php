<?php

namespace MarinusJvv\Sudoku\Calculation;

use MarinusJvv\Sudoku\Board\Block;
use MarinusJvv\Sudoku\Board\Board;

class ValueSetterTest extends \PHPUnit_Framework_TestCase
{
    public function testSetValueForSingleValueAvailable()
    {
        $value = 3;
        $colPosition = 2;
        $rowPosition = 5;
        $board = new Board();
        $block = new Block();
        $block->setPossibleValues([$value]);

        $row = $board->getRow($rowPosition);
        $row->setBlock($colPosition, $block);

        $valueSetter = new ValueSetter();
        $valueSetter->setValueForSingleValueAvailable($board, $rowPosition, $row);

        $this->assertEquals($value, $row->getBlock($colPosition)->getValue());
        $this->assertEquals(0, count($row->getBlock($colPosition)->getPossibleValues()));
        $this->assertEquals([$value], $board->getColumn($colPosition)->getSetValues());
    }

    public function testSweepForSettingSingleAvailableValues()
    {
        $row = 4;
        $col = 2;
        $value = 9;
        $board = new Board();

        $board->getRow($row)->getBlock($col)->setPossibleValues([$value]);
        $this->assertEquals(0,  $board->getRow($row)->getBlock($col)->getValue());

        $valueSetter = new ValueSetter();
        $valueSetter->sweepForSettingSingleAvailableValues($board);

        $this->assertEquals($value, $board->getRow($row)->getBlock($col)->getValue());
        $this->assertEquals(0, count($board->getRow($row)->getBlock($col)->getPossibleValues()));
    }

    public function testSweepForSettingValuesPossibleOnlyOnePlace()
    {
        $board = new Board();
        $row = 3;
        $column = 2;
        $value = 4;

        /** @var Block $block */
        foreach ($board->getRow($row)->getBlocks() as $block) {
            $block->removePossibleValue($value);
        }
        $board->getRow($row)->getBlock($column)->setPossibleValues(range(1, PUZZLE_SIZE));

        $valueSetter = new ValueSetter();
        $valueSetter->sweepForSettingValuesPossibleOnlyOnePlace($board);

        $this->assertEquals($value, $board->getRow($row)->getBlock($column)->getValue());
    }

    public function testSweepForSettingValuesPossibleOnlyOnePlaceInContainer()
    {
        $board = new Board();
        $row = $board->getRow(3);
        $column = 2;
        $value = 4;

        /** @var Block $block */
        foreach ($row->getBlocks() as $block) {
            $block->removePossibleValue($value);
        }
        $row->getBlock($column)->setPossibleValues(range(1, PUZZLE_SIZE));

        $valueSetter = new ValueSetter();
        $valueSetter->setValueWherePossibleOnlyOnePlaceByContainer($row);

        $this->assertEquals($value, $row->getBlock($column)->getValue());
    }
}
