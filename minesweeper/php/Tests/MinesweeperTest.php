<?php

namespace Tests;

use Egulias\Minesweeper;

class MinesweeperTest extends \PHPUnit_Framework_TestCase
{
    public function testMineSorround()
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 'X';
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineSweeper = new Minesweeper($field);
        $result = $mineSweeper->sweep();
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(1, $result[0][1]);
        $this->assertEquals(1, $result[0][2]);
        $this->assertEquals(1, $result[1][0]);
        $this->assertEquals(1, $result[1][2]);
        $this->assertEquals(1, $result[2][0]);
        $this->assertEquals(1, $result[2][1]);
        $this->assertEquals(1, $result[2][2]);
    }

    public function testMinesPosition()
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 'X';
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineSweeper = new Minesweeper($field);
        $mineSweeper->sweep();
        $this->assertEquals([1 => [1 => true]], $mineSweeper->getMines());
    }

    public function testTopLeftEdgeMineSorround()
    {
        $field[0][0] = 'X';
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 0;
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineSweeper = new Minesweeper($field);
        $result = $mineSweeper->sweep();
        $this->assertEquals(1, $result[0][1]);
        $this->assertEquals(0, $result[0][2]);
        $this->assertEquals(1, $result[1][0]);
        $this->assertEquals(1, $result[1][1]);
        $this->assertEquals(0, $result[1][2]);
        $this->assertEquals(0, $result[2][0]);
        $this->assertEquals(0, $result[2][1]);
        $this->assertEquals(0, $result[2][2]);
    }

    public function testBottomRightEdgeMineSorround()
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 0;
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 'X';

        $mineSweeper = new Minesweeper($field);
        $result = $mineSweeper->sweep();
        $this->assertEquals(0, $result[0][0]);
        $this->assertEquals(0, $result[0][1]);
        $this->assertEquals(0, $result[0][2]);
        $this->assertEquals(0, $result[1][0]);
        $this->assertEquals(1, $result[1][1]);
        $this->assertEquals(1, $result[1][2]);
        $this->assertEquals(0, $result[2][0]);
        $this->assertEquals(1, $result[2][1]);
    }

    public function testMinesFound()
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 'X';
        $field[1][2] = 0;
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineSweeper = new Minesweeper($field);
        $mineSweeper->sweep();
        $this->assertEquals(1, $mineSweeper->getMinesFound());

    }
}
