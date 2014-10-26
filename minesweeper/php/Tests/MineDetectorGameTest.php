<?php

namespace Tests;

use Egulias\Minesweeper;
use Egulias\MineDetectorGame;
use Egulias\MineGenerator;

/**
 * MineDetectorGameTest
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @copyright Copyright
 */
class MineDetectorGameTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewGame()
    {
        $mg = new MineGenerator(2, 2, 1);
        $mineDetector = new MineDetectorGame($mg);
        $this->assertCount(0, $mineDetector->getClearedFields());
    }

    public function testContinueGame()
    {
        $mg = new MineGenerator(2, 2, 1);
        $mineDetector = new MineDetectorGame($mg);
        $cleared = $mineDetector->continueGame($mg->getFieldWithMines(), [[0, 0]]);
        $this->assertEquals([[0, 0]], $cleared['clear']);
    }

    public function testContinueGameMarkedMines()
    {
        $mg = new MineGenerator(2, 2, 1);
        $mineDetector = new MineDetectorGame($mg);
        $marked = $mineDetector->continueGame($mg->getFieldWithMines(), [[0, 0]], [[1, 1]]);
        $this->assertEquals([[1, 1]], $marked['marked']);
    }
    /**
     *
     * @expectedException Egulias\MineExplodedException
     */
    public function testCoordinatesIsMine()
    {
        $mg = new MineGenerator(1, 1, 1);
        $mineDetector = new MineDetectorGame($mg);
        $mineDetector->clear(0, 0);
    }

    public function testMarkMine()
    {
        $total = 0;
        $field = array_fill(0, 2, array_fill(0, 2, 0));
        $field[1][1] = 'M';
        $mgMock = $this->getMockForAbstractClass('Egulias\MineGeneratorStrategy');
        $mgMock->expects($this->once())->method('getFieldWithMines')->will($this->returnValue($field));
        $mineDetector = new MineDetectorGame($mgMock);
        $this->assertCount(1, $mineDetector->markMine(1, 1, 'Y'));
        $this->assertEquals('Y', $mineDetector->markMine(1, 1, 'Y')[1][1]);
    }

    public function testDiscoveredZones()
    {
        $total = 0;
        $field = array_fill(0, 2, array_fill(0, 2, 0));
        $field[1][1] = 'M';
        $mgMock = $this->getMockForAbstractClass('Egulias\MineGeneratorStrategy');
        $mgMock->expects($this->once())->method('getFieldWithMines')->will($this->returnValue($field));
        $mineDetector = new MineDetectorGame($mgMock);
        $clearedFields = $mineDetector->clear(0, 0);
        foreach ($clearedFields as $y) {
            foreach ($y as $x) {
                $total++;
            }
        }
        $this->assertEquals(3, $total);
    }
}
