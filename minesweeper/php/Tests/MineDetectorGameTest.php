<?php

namespace Tests;

use Egulias\Minesweeper;
use Egulias\MineDetectorGame;

/**
 * MineDetectorGameTest
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @copyright Copyright
 */
class MineDetectorGameTest extends \PHPUnit_Framework_TestCase
{
    public function testField()
    {
        $mineDetector = new MineDetectorGame(2, 2);
        $field = $mineDetector->getField();
        $this->assertInstanceOf('Egulias\MineField', $field);
    }

    /**
     *
     * @expectedException Egulias\MineExplodedException
     */
    public function testCoordinatesIsMine()
    {
        $mineDetector = new MineDetectorGame(2, 2);
        $mineDetector->clear(0, 0);
        $mineDetector->clear(0, 1);
        $mineDetector->clear(1, 0);
        $mineDetector->clear(1, 1);
    }

    public function testDiscoveredZones()
    {
        $mineDetector = new MineDetectorGame(2, 2);
        $field = $mineDetector->clear(0, 0);
        var_dump($field);
    }
}
