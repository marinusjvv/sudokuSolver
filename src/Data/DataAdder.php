<?php

namespace MarinusJvv\Sudoku\Data;

use MarinusJvv\Sudoku\Board\Board;

class DataAdder
{
    /**
     * @param Board $board
     * @param integer $row
     * @param integer $column
     * @param integer $value
     * @return Board
     */
    public static function addNumber(Board $board, $row, $column, $value)
    {
        $board->setValueByRow($row, $column, $value);
        return $board;
    }

    /**
     * @param Board $board
     * @param array $data
     * @return Board
     */
    public static function addDataArray(Board $board, array $data)
    {
        foreach ($data as $item) {
            $board = self::addNumber($board, $item[0], $item[1], $item[2]);
        }
        return $board;
    }

    /**
     * @param Board $board
     * @param $dataLocation
     * @return Board
     */
    public static function addDataCSVFile(Board $board, $dataLocation)
    {
        $handle = fopen($dataLocation, 'r');

        while (($item = fgetcsv($handle))) {
            $board = self::addNumber($board, (int)$item[0], (int)$item[1], (int)$item[2]);
        }
        return $board;
    }
}
