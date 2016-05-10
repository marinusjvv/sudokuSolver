<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Display\BoardVisualizer;
use MarinusJvv\Sudoku\Solver;

class SolverTest extends \PHPUnit_Framework_TestCase
{
    public function testSolver()
    {
        $solver = new Solver();
        $solver->addData( __DIR__ . '/data/easyPuzzle.csv');
        $solver->solvePuzzle();
        $data = BoardVisualizer::getBoardDisplayArray($solver->getBoard());
        $this->assertEquals($this->getExpectedData(), $data);
    }

    private function getExpectedData()
    {
        return [
            1 => [1 => 1, 2 => 6, 3 => 7, 4 => 8, 5 => 9, 6 => 4, 7 => 5, 8 => 2, 9 => 3],
            2 => [1 => 8, 2 => 9, 3 => 2, 4 => 5, 5 => 6, 6 => 3, 7 => 7, 8 => 1, 9 => 4],
            3 => [1 => 5, 2 => 4, 3 => 3, 4 => 1, 5 => 2, 6 => 7, 7 => 9, 8 => 8, 9 => 6],
            4 => [1 => 6, 2 => 7, 3 => 1, 4 => 4, 5 => 8, 6 => 5, 7 => 2, 8 => 3, 9 => 9],
            5 => [1 => 4, 2 => 2, 3 => 9, 4 => 3, 5 => 1, 6 => 6, 7 => 8, 8 => 5, 9 => 7],
            6 => [1 => 3, 2 => 5, 3 => 8, 4 => 2, 5 => 7, 6 => 9, 7 => 6, 8 => 4, 9 => 1],
            7 => [1 => 2, 2 => 8, 3 => 6, 4 => 9, 5 => 3, 6 => 1, 7 => 4, 8 => 7, 9 => 5],
            8 => [1 => 7, 2 => 1, 3 => 5, 4 => 6, 5 => 4, 6 => 2, 7 => 3, 8 => 9, 9 => 8],
            9 => [1 => 9, 2 => 3, 3 => 4, 4 => 7, 5 => 5, 6 => 8, 7 => 1, 8 => 6, 9 => 2],
        ];
    }
}
