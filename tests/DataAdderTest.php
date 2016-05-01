<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Data\DataAdder;

class DataAdderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Board
     */
    private $board;

    public function setUp()
    {
        $this->board = new Board();
    }

    public function testAddNumber()
    {
        $board = DataAdder::addNumber($this->board, 3, 4, 9);

        $this->assertEquals(9, $board->getColumn(4)->getBlock(3)->getValue());
    }

    public function testAddDataArray()
    {
        $data = [
            [3, 4, 9],
            [5, 9, 1],
            [2, 4, 6],
        ];

        $board = DataAdder::addDataArray($this->board, $data);

        $this->assertEquals(9, $board->getColumn(4)->getBlock(3)->getValue());
        $this->assertEquals(1, $board->getColumn(9)->getBlock(5)->getValue());
        $this->assertEquals(6, $board->getColumn(4)->getBlock(2)->getValue());
    }

    public function testAddDataCSVFile()
    {
        $board = DataAdder::addDataCSVFile($this->board, __DIR__ . '/data/exampleData.csv');

        $this->assertEquals(9, $board->getColumn(4)->getBlock(3)->getValue());
        $this->assertEquals(1, $board->getColumn(9)->getBlock(5)->getValue());
        $this->assertEquals(6, $board->getColumn(4)->getBlock(2)->getValue());
    }
}
