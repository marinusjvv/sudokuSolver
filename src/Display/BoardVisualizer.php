<?php

namespace MarinusJvv\Sudoku\Display;

use MarinusJvv\Sudoku\Board\Board;

class BoardVisualizer
{
    /**
     * @param Board $board
     * @param null $defaultValue
     * @return array
     */
    public static function getBoardDisplayArray(Board $board, $defaultValue = null)
    {
        $result = [];
        for ($row = 1; $row <= PUZZLE_SIZE; $row++) {
            $result[$row] = [];
            for ($column = 1; $column <= PUZZLE_SIZE; $column++) {
                $result[$row][$column] = self::getValueUsingRowAndColumn($board, $row, $column, $defaultValue);
            }
        }
        return $result;
    }

    /**
     * @param Board $board
     * @param string $defaultValue
     * @param bool $showColours
     * @return string
     */
    public static function getBoardDisplayString(Board $board, $defaultValue = ' ', $showColours = false)
    {
        $newValues = $board->getRecentlyCalculatedPositions();
        $linePositions = [1, 4, 7];
        $result = '';
        for ($row = 1; $row <= PUZZLE_SIZE; $row++) {
            if (in_array($row, $linePositions)) {
                $result .= ' --- --- --- ' . PHP_EOL;
            }
            for ($column = 1; $column <= PUZZLE_SIZE; $column++) {
                if (in_array($column, $linePositions)) {
                    $result .= '|';
                }
                $additionalValue = self::getValueUsingRowAndColumn($board, $row, $column, $defaultValue);
                if ($showColours && array_key_exists($row, $newValues) && in_array($column, $newValues[$row])) {
                    $additionalValue = "\033[31m" . $additionalValue . "\033[0m";
                }
                $result .= $additionalValue;
                if (self::isLast($column)) {
                    $result .= '|' . PHP_EOL;
                }
            }
            if (self::isLast($row)) {
                $result .= ' --- --- --- ' . PHP_EOL;
            }
        }
        return $result;
    }

    /**
     * @param Board $board
     * @param $row
     * @param $column
     * @param $defaultValue
     * @return mixed
     */
    protected static function getValueUsingRowAndColumn(Board $board, $row, $column, $defaultValue)
    {
        $value = (int)$board->getRow($row)->getBlock($column)->getValue();
        return $value === 0
            ? $defaultValue
            : $value;
    }

    /**
     * @param $position
     * @param int $size
     * @return bool
     */
    protected static function isLast($position, $size = PUZZLE_SIZE)
    {
        return $position === $size;
    }
}
