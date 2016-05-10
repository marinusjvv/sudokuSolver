<?php

namespace MarinusJvv\Sudoku\Calculation;

use MarinusJvv\Sudoku\Board\Block;
use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Board\Containers\AbstractContainer;
use MarinusJvv\Sudoku\Board\Utilities\SectionPositionCalculator;

class ValueEliminator
{
    /**
     * @param Board $board
     */
    public function eliminatePossibilitiesForAllSetValues(Board $board)
    {
        /**
         * @var integer $rowNumber
         * @var  Row $row
         */
        foreach ($board->getRows() as $rowNumber => $row) {
            /**
             * @var integer $blockNumber
             * @var  Block $block
             */
            foreach ($row->getBlocks() as $columnNumber => $block) {
                if ($block->getValue() !== 0) {
                    $sectionNumber = SectionPositionCalculator::getSectionPosition($columnNumber, $rowNumber);
                    $this->eliminatePossibleValuesInContainer($row, $block->getValue());
                    $this->eliminatePossibleValuesInContainer($board->getColumn($columnNumber), $block->getValue());
                    $this->eliminatePossibleValuesInContainer($board->getSection($sectionNumber), $block->getValue());
                }
            }
        }
    }

    /**
     * @param AbstractContainer $container
     * @param $value
     */
    public function eliminatePossibleValuesInContainer(AbstractContainer $container, $value)
    {
        /** @var Block $block */
        foreach ($container->getBlocks() as $block) {
            $block->removePossibleValue($value);
        }
    }
}
