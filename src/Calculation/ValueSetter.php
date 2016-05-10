<?php

namespace MarinusJvv\Sudoku\Calculation;

use MarinusJvv\Sudoku\Board\Block;
use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Board\Containers\AbstractContainer;
use MarinusJvv\Sudoku\Board\Containers\Column;
use MarinusJvv\Sudoku\Board\Containers\Row;
use MarinusJvv\Sudoku\Board\Containers\Section;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class ValueSetter
{
    /**
     * @var BoardMetaData
     */
    protected $boardMetaData;

    /**
     * ValueSetter constructor.
     */
    public function __construct()
    {
        $this->boardMetaData = new BoardMetaData();
    }

    /**
     * @param Board $board
     * @param $rowNumber
     * @param Row $row
     * @throws \MarinusJvv\Sudoku\Board\Exceptions\InvalidValueException
     */
    public function setValueForSingleValueAvailable(Board $board, $rowNumber, Row $row)
    {
        /** @var Block $block */
        foreach ($row->getBlocks() as $position => $block) {
            if (!$block->hasOnlyOnePossibleValue()) {
                continue;
            }
            $value = array_pop($block->getPossibleValues());
            $block->setCalculatedValue($value);
            $this->boardMetaData->recordSetValue($board, $rowNumber, $position, $value);
        }
    }

    /**
     * @param Board $board
     */
    public function sweepForSettingSingleAvailableValues(Board $board)
    {
        /** @var Row $row */
        foreach ($board->getRows() as $position => $row) {
            $this->setValueForSingleValueAvailable($board, $position, $row);
        }
    }

    /**
     * @param Board $board
     */
    public function sweepForSettingValuesPossibleOnlyOnePlace(Board $board)
    {
        /** @var Row $row */
        foreach ($board->getRows() as $row) {
            $this->setValueWherePossibleOnlyOnePlaceByContainer($row);
        }
        /** @var Column $column */
        foreach ($board->getColumns() as $column) {
            $this->setValueWherePossibleOnlyOnePlaceByContainer($column);
        }
        /** @var Section $section */
        foreach ($board->getSections() as $section) {
            $this->setValueWherePossibleOnlyOnePlaceByContainer($section);
        }
    }

    /**
     * @param AbstractContainer $container
     * @throws \MarinusJvv\Sudoku\Board\Exceptions\InvalidValueException
     */
    public function setValueWherePossibleOnlyOnePlaceByContainer(AbstractContainer $container)
    {
        for ($possibleValue=1; $possibleValue<=PUZZLE_SIZE; $possibleValue++) {
            $availablePositions = 0;
            $position = 0;
            /** @var Block $block */
            for ($i=1; $i<=PUZZLE_SIZE; $i++) {
                $block = $container->getBlock($i);
                if ($block->hasPossibleValue($possibleValue)) {
                    $position = $i;
                    $availablePositions++;
                }
                if ($availablePositions > 1) {
                    continue 2;
                }
            }
            if ($availablePositions === 1) {
                $container->getBlock($position)->setCalculatedValue($possibleValue);
            }
        }
    }
}
