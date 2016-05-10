<?php

namespace MarinusJvv\Sudoku\Calculation;

use MarinusJvv\Sudoku\Board\Block;
use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Data\DataAdder;

class ValueEliminatorTest extends \PHPUnit_Framework_TestCase
{
    public function testEliminateValueByRow_ValueAndPosition_RemovesValueFromAllBlocks()
    {
        $row = 5;
        $value = 9;
        $board = new Board();
        $valueEliminator = new ValueEliminator();

        $valueEliminator->eliminatePossibleValuesInContainer($board->getRow($row), $value);

        for ($i=1; $i<=PUZZLE_SIZE; $i++) {
            $this->assertFalse($board->getColumn($i)->getBlock($row)->hasPossibleValue($value));
            $this->asserttrue($board->getColumn($i)->getBlock($row)->hasPossibleValue(1));
        }
    }

    public function testEliminateValueByColumn_ValueAndPosition_RemovesValueFromAllBlocks()
    {
        $column = 5;
        $value = 9;
        $board = new Board();
        $valueEliminator = new ValueEliminator();

        $valueEliminator->eliminatePossibleValuesInContainer($board->getColumn($column), $value);

        for ($i=1; $i<=PUZZLE_SIZE; $i++) {
            $this->assertFalse($board->getRow($i)->getBlock($column)->hasPossibleValue($value));
            $this->asserttrue($board->getRow($i)->getBlock($column)->hasPossibleValue(1));
        }
    }

    public function testEliminateValueBySection_ValueAndPosition_RemovesValueFromAllBlocks()
    {
        $section = 5;
        $value = 9;
        $board = new Board();
        $valueEliminator = new ValueEliminator();

        $valueEliminator->eliminatePossibleValuesInContainer($board->getSection($section), $value);

        $this->assertFalse($board->getColumn(4)->getBlock(4)->hasPossibleValue($value));
        $this->asserttrue($board->getColumn(4)->getBlock(4)->hasPossibleValue(1));
        $this->assertFalse($board->getColumn(5)->getBlock(5)->hasPossibleValue($value));
        $this->asserttrue($board->getColumn(5)->getBlock(5)->hasPossibleValue(1));
        $this->assertFalse($board->getColumn(6)->getBlock(6)->hasPossibleValue($value));
        $this->asserttrue($board->getColumn(6)->getBlock(6)->hasPossibleValue(1));
    }

    public function testSweepForEliminationOfPossibleValues()
    {
        $board = new Board();

        /** @var Block $block */
        foreach ($board->getRow(3)->getBlocks() as $block) {
            $this->assertTrue($block->hasPossibleValue(9));
        }
        /** @var Block $block */
        foreach ($board->getRow(5)->getBlocks() as $block) {
            $this->assertTrue($block->hasPossibleValue(1));
        }
        /** @var Block $block */
        foreach ($board->getRow(2)->getBlocks() as $block) {
            $this->assertTrue($block->hasPossibleValue(6));
        }

        $dataAdder = new DataAdder();
        $dataAdder->addDataCSVFile($board, __DIR__ . '/data/exampleData.csv');
        $valueEliminator = new ValueEliminator();
        $valueEliminator->eliminatePossibilitiesForAllSetValues($board);

        /** @var Block $block */
        foreach ($board->getRow(3)->getBlocks() as $block) {
            $this->assertFalse($block->hasPossibleValue(9));
        }
        /** @var Block $block */
        foreach ($board->getRow(5)->getBlocks() as $block) {
            $this->assertFalse($block->hasPossibleValue(1));
        }
        /** @var Block $block */
        foreach ($board->getRow(2)->getBlocks() as $block) {
            $this->assertFalse($block->hasPossibleValue(6));
        }
    }
}
