<?php

namespace MarinusJvv\Sudoku;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Calculation\ValueEliminator;
use MarinusJvv\Sudoku\Calculation\ValueSetter;
use MarinusJvv\Sudoku\Data\DataAdder;
use MarinusJvv\Sudoku\Display\BoardVisualizer;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class Solver
{
    /**
     * @var Board
     */
    protected $board;
    protected $valueEliminator;
    protected $boardMetaData;
    protected $valueSetter;
    protected $dataAdder;

    public function __construct()
    {
        $this->board = new Board();
        $this->valueEliminator = new ValueEliminator();
        $this->valueSetter = new ValueSetter();
        $this->boardMetaData = new BoardMetaData();
        $this->dataAdder = new DataAdder();
    }

    public function addData($location)
    {
        $this->dataAdder->addDataCSVFile($this->board, $location);
    }

    public function solvePuzzle($maxIncrements = 50)
    {
        $inc = 0;
        while ($this->boardMetaData->isBoardComplete($this->board) === false) {
            $this->valueEliminator->eliminatePossibilitiesForAllSetValues($this->board);
            $this->valueSetter->sweepForSettingSingleAvailableValues($this->board);
            //TODO:
            //$this->valueSetter->sweepForSettingValuesPossibleOnlyOnePlace($this->board);
            if (++$inc === $maxIncrements) {
                break;
            }
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
