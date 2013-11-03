<?php

namespace Tests;

use Egulias\Minesweeper;

class DifferentMineMarkerTest extends \PHPUnit_Framework_TestCase
{
    public function mineMarkers()
    {
        return [['T'], ['X'], ['M']];
    }

    /**
     *
     * @dataProvider mineMarkers
     */
    public function testMineSorround($mineMarker)
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = $mineMarker;
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineSweeper = new Minesweeper($field, $mineMarker);
        $result = $mineSweeper->sweep();
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(1, $result[0][1]);
        $this->assertEquals(1, $result[0][2]);
        $this->assertEquals(1, $result[1][0]);
        $this->assertEquals($mineMarker, $result[1][1]);
        $this->assertEquals(1, $result[1][2]);
        $this->assertEquals(1, $result[2][0]);
        $this->assertEquals(1, $result[2][1]);
        $this->assertEquals(1, $result[2][2]);
    }
}
