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
     * @expectedexception \Egulias\GameWinException
     */
    public function testWinGame()
    {
        $total = 0;
        $field = array_fill(0, 2, array_fill(0, 2, 0));
        $field[1][1] = 'M';
        $mineDetector = new MineDetectorGame($field);
        $mineDetector->clear(0, 0);
        $mineDetector->markMine(1, 1);
    }
}