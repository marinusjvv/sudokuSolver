<?php

namespace MarinusJvv\Sudoku\Board\Utilities;

class SectionPositionCalculator
{
    /**
     * @param $columnPosition
     * @param $rowPosition
     * @return float
     */
    public static function getSectionPosition($columnPosition, $rowPosition)
    {
        return (ceil($columnPosition / 3)) + ((ceil($rowPosition / 3) - 1) * 3);
    }

    /**
     * @param $columnPosition
     * @param $rowPosition
     * @return mixed
     */
    public static function getSectionBlockPosition($columnPosition, $rowPosition)
    {
        while ($columnPosition > 3) {
            $columnPosition -= 3;
        }
        while ($rowPosition > 3) {
            $rowPosition -= 3;
        }
        return $columnPosition + (($rowPosition - 1) * 3);
    }
}
