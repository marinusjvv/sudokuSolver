<?php

namespace MarinusJvv\Sudoku\Data;

use MarinusJvv\Sudoku\Board\Board;

class DataAdder
{
    public function addNumber(Board $board, $row, $column, $value)
    {
        $board->setValueByRow($row, $column, $value);
        return $board;
    }

    public function addDataArray(Board $board, array $data)
    {
        foreach ($data as $item) {
            $board = $this->addNumber($board, $item[0], $item[1], $item[2]);
        }
        return $board;
    }

    public function addDataCSVFile(Board $board, $dataLocation)
    {
        $handle = fopen($dataLocation, 'r');

        while (($item = fgetcsv($handle))) {
            $board = $this->addNumber($board, (int)$item[0], (int)$item[1], (int)$item[2]);
        }
        return $board;
    }
}
