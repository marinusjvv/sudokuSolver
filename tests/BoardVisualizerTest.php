<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Data\DataAdder;
use MarinusJvv\Sudoku\Display\BoardVisualizer;

class BoardVisualizerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBoardDisplayArray()
    {
        $board = new Board();
        $dataAdder = new DataAdder();
        $dataAdder->addDataCSVFile($board, __DIR__ . '/data/exampleData.csv');
        $returned = BoardVisualizer::getBoardDisplayArray($board);
        $this->assertEquals($this->getExpectedBoardDisplayArray(), $returned);
    }

    public function testGetBoardDisplayString()
    {
        $board = new Board();
        $dataAdder = new DataAdder();
        $dataAdder->addDataCSVFile($board, __DIR__ . '/data/exampleData.csv');
        $returned = BoardVisualizer::getBoardDisplayString($board);
        $this->assertEquals($this->getExpectedBoardDisplayString(), $returned);
    }

    protected function getExpectedBoardDisplayArray()
    {
        return [
            1 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            2 => [
                1 => null, 2 => null, 3 => null, 4 => 6, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            3 => [
                1 => null, 2 => null, 3 => null, 4 => 9, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            4 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            5 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => 1
            ],
            6 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            7 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            8 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
            9 => [
                1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null
            ],
        ];
    }

    protected function getExpectedBoardDisplayString()
    {
        return ' --- --- --- ' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . '|   |6  |   |' . PHP_EOL
            . '|   |9  |   |' . PHP_EOL
            . ' --- --- --- ' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . '|   |   |  1|' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . ' --- --- --- ' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . '|   |   |   |' . PHP_EOL
            . ' --- --- --- ' . PHP_EOL;
    }
}
