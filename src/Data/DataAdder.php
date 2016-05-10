<?php

namespace MarinusJvv\Sudoku\Data;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class DataAdder
{
    /**
     * @var BoardMetaData
     */
    protected $boardMetaData;

    public function __construct()
    {
        $this->boardMetaData = new BoardMetaData();
    }

    /**
     * @param Board $board
     * @param integer $row
     * @param integer $column
     * @param integer $value
     */
    public function addNumber(Board $board, $row, $column, $value)
    {
        $this->boardMetaData->recordSetValue($board, $row, $column, $value);
        $board->setValueByRow($row, $column, $value);
    }

    /**
     * @param Board $board
     * @param array $data
     */
    public function addDataArray(Board $board, array $data)
    {
        foreach ($data as $item) {
            $this->addNumber($board, $item[0], $item[1], $item[2]);
        }
    }

    /**
     * @param Board $board
     * @param $dataLocation
     */
    public function addDataCSVFile(Board $board, $dataLocation)
    {
        $handle = fopen($dataLocation, 'r');
        while (($item = fgetcsv($handle))) {
            $this->addNumber($board, (int)$item[0], (int)$item[1], (int)$item[2]);
        }
    }
}
