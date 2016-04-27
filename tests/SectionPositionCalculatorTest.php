<?php

namespace MarinusJvv\Tests;

use MarinusJvv\Sudoku\Board\Utilities\SectionPositionCalculator;

class SectionPositionCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sectionPositionProvider
     * @param $row
     * @param $column
     * @param $section
     */
    public function testCalculateSectionPosition($row, $column, $section)
    {
        $this->assertEquals($section, SectionPositionCalculator::getSectionPosition($column, $row));
    }

    public function sectionPositionProvider()
    {
        return [
            [1, 1, 1],
            [9, 9, 9],
            [1, 4, 2],
            [7, 1, 7],
            [4, 7, 6],
        ];
    }

    /**
     * @dataProvider sectionBlockPositionProvider
     * @param $row
     * @param $column
     * @param $section
     */
    public function testCalculateSectionBlockPosition($row, $column, $section)
    {
        $this->assertEquals($section, SectionPositionCalculator::getSectionBlockPosition($column, $row));
    }

    public function sectionBlockPositionProvider()
    {
        return [
            [1, 1, 1],
            [9, 9, 9],
            [1, 4, 1],
            [7, 1, 1],
            [4, 7, 1],
            [5, 5, 5],
        ];
    }
}
