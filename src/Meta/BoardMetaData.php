<?php

namespace MarinusJvv\Sudoku\Meta;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Board\Containers\Row;
use MarinusJvv\Sudoku\Board\Utilities\SectionPositionCalculator;

class BoardMetaData
{
    /**
     * @param Board $board
     * @param $row
     * @param $column
     * @param $value
     */
    public function recordSetValue(Board $board, $row, $column, $value)
    {
        $board->getRow($row)->setSetValue($value);
        $board->getColumn($column)->setSetValue($value);
        $section = SectionPositionCalculator::getSectionPosition($column, $row);
        $board->getSection($section)->setSetValue($value);
        $board->noteRecentlyCalculatedPosition($row, $column);
    }

    /**
     * @param Board $board
     * @return bool
     */
    public function isBoardComplete(Board $board)
    {
        /** @var Row $row */
        foreach ($board->getRows() as $row) {
            if (count($row->getSetValues()) !== PUZZLE_SIZE) {
                return false;
            }
        }
        return true;
    }
}
