<?php

namespace MarinusJvv\Sudoku;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Calculation\ValueEliminator;
use MarinusJvv\Sudoku\Calculation\ValueSetter;
use MarinusJvv\Sudoku\Data\DataAdder;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class Solver
{
    /**
     * @var Board
     */
    protected $board;
    /**
     * @var ValueEliminator
     */
    protected $valueEliminator;
    /**
     * @var BoardMetaData
     */
    protected $boardMetaData;
    /**
     * @var ValueSetter
     */
    protected $valueSetter;
    /**
     * @var DataAdder
     */
    protected $dataAdder;

    /**
     * Solver constructor.
     */
    public function __construct()
    {
        $this->board = new Board();
        $this->valueEliminator = new ValueEliminator();
        $this->valueSetter = new ValueSetter();
        $this->boardMetaData = new BoardMetaData();
        $this->dataAdder = new DataAdder();
    }

    /**
     * @param $location
     */
    public function addData($location)
    {
        $this->dataAdder->addDataCSVFile($this->board, $location);
    }

    public function addValue($row, $column, $value)
    {
        $this->dataAdder->addNumber($this->board, $row, $column, $value);
    }

    /**
     * @param bool $maxSolves
     */
    public function solvePuzzle($maxSolves = false)
    {
        while ($this->boardMetaData->isBoardComplete($this->board) === false) {
            $this->valueEliminator->eliminatePossibilitiesForAllSetValues($this->board);
            $this->valueSetter->sweepForSettingSingleAvailableValues($this->board, $maxSolves);
            //TODO:
            //$this->valueSetter->sweepForSettingValuesPossibleOnlyOnePlace($this->board);
        }
    }

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }
}
