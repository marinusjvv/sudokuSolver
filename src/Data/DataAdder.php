<?php

namespace MarinusJvv\Sudoku\Data;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Exceptions\InvalidFileLocationException;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class DataAdder
{
    /**
     * @var BoardMetaData
     */
    protected $boardMetaData;

    /**
     * DataAdder constructor.
     */
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
        $this->validateInputs([$row, $column, $value]);
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
     * @throws InvalidFileLocationException
     */
    public function addDataCSVFile(Board $board, $dataLocation)
    {
        if (!is_readable($dataLocation)) {
            throw new InvalidFileLocationException();
        }
        $handle = fopen($dataLocation, 'r');
        while (($item = fgetcsv($handle))) {
            $this->addNumber($board, (int)$item[0], (int)$item[1], (int)$item[2]);
        }
    }

    private function validateInputs($inputs)
    {
        foreach ($inputs as $input) {
            if ((int)$input < 1 || (int)$input > PUZZLE_SIZE) {
                throw new \InvalidArgumentException('Invalid value: ' . $input);
            }
        }
    }
}
