<?php

namespace Tests;

use Egulias\MineDetectorGame;
use Egulias\MineGenerator;

/**
 * MineDetectorGameTest
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @copyright Copyright
 */
class MineDetectorGameWinnerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @expectedException \Egulias\GameWinException
     */
    public function testWinGame()
    {
        $field = array_fill(0, 2, array_fill(0, 2, 0));
        $field[1][1] = 'M';
        $mgMock = $this->getMockForAbstractClass('Egulias\MineGeneratorStrategy');
        $mgMock->expects($this->once())->method('getFieldWithMines')->will($this->returnValue($field));
        $mineDetector = new MineDetectorGame($mgMock);
        $mineDetector->clear(0, 0);
        $mineDetector->markMine(1, 1);
    }

    public function testNotWinGameUnlessClear()
    {
        $field = array_fill(0, 2, array_fill(0, 2, 0));
        $field[1][1] = 'M';
        $mgMock = $this->getMockForAbstractClass('Egulias\MineGeneratorStrategy');
        $mgMock->expects($this->once())->method('getFieldWithMines')->will($this->returnValue($field));
        $mineDetector = new MineDetectorGame($mgMock);
        $this->assertEquals([1 => [1 => 'X']], $mineDetector->markMine(1, 1));
    }
}
