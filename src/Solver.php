<?php

namespace MarinusJvv\Sudoku;

use MarinusJvv\Sudoku\Board\Board;

class Solver
{
    /**
     * @var Board
     */
    protected $board;

    public function __construct()
    {
        $this->board = new Board();
    }

    public function addData()
    {

    }
}
