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
    /**
     *
     * @expectedException MineExplodedException
     */
    public function testCoordinatesIsMine()
    {
        $field[0][0] = 0;
        $field[0][1] = 0;
        $field[0][2] = 0;
        $field[1][0] = 0;
        $field[1][1] = 0;
        $field[1][2] = 'M';
        $field[2][0] = 0;
        $field[2][1] = 0;
        $field[2][2] = 0;

        $mineDetector = new MineDetectorGame(new Minesweeper($field, 'M'));
        $mineDetector->clear(1, 2);
    }
}
