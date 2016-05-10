<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Board;
use MarinusJvv\Sudoku\Board\Containers\Row;
use MarinusJvv\Sudoku\Meta\BoardMetaData;

class BoardMetaDataTest extends \PHPUnit_Framework_TestCase
{
    public function testRecordSetValue()
    {
        $board = new Board();
        $boardMeta = new BoardMetaData();

        $boardMeta->recordSetValue($board, 3, 4, 9);
        $boardMeta->recordSetValue($board, 5, 9, 1);
        $boardMeta->recordSetValue($board, 2, 4, 6);

        $this->assertEquals([9, 6], $board->getColumn(4)->getSetValues());
        $this->assertEquals([1], $board->getColumn(9)->getSetValues());

        $this->assertEquals([9, 6], $board->getSection(2)->getSetValues());
        $this->assertEquals([1], $board->getSection(6)->getSetValues());
    }

    public function testIsBoardComplete()
    {
        $board = new Board();
        /** @var Row $row */
        foreach ($board->getRows() as $row) {
            for ($i=1; $i<=PUZZLE_SIZE; $i++) {
                $row->setSetValue($i);
            }
        }

        $boardMetaData = new BoardMetaData();
        $this->assertTrue($boardMetaData->isBoardComplete($board));
    }
}
