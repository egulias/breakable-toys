<?php

namespace Tests;

use Egulias\Minesweeper;

class BigMinesweeperTest extends \PHPUnit_Framework_TestCase
{
    public function testMultipleMines()
    {
        $field[0][0] = 'X';
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[0][3] = 0;
        $field[1][0] = 0;
        $field[1][1] = 'X';
        $field[1][2] = 0;
        $field[1][3] = 'X';
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;
        $field[2][3] = 0;
        $field[3][0] = 'X';
        $field[3][1] = 'X';
        $field[3][2] = 0;
        $field[3][3] = 0;

        $mineSweeper = new Minesweeper($field);
        $result = $mineSweeper->sweep();
        $this->assertEquals('X', $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(2, $result[0][2]);
        $this->assertEquals(1, $result[0][3]);
        $this->assertEquals(2, $result[1][0]);
        $this->assertEquals('X', $result[1][1]);
        $this->assertEquals(2, $result[1][2]);
        $this->assertEquals('X', $result[1][3]);
        $this->assertEquals(3, $result[2][0]);
        $this->assertEquals(3, $result[2][1]);
        $this->assertEquals(3, $result[2][2]);
        $this->assertEquals(1, $result[2][3]);
        $this->assertEquals('X', $result[3][0]);
        $this->assertEquals('X', $result[3][1]);
        $this->assertEquals(1, $result[3][2]);
        $this->assertEquals(0, $result[3][3]);
    }
}
