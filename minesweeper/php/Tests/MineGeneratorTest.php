<?php

namespace Tests;

use Egulias\MineGenerator;

class MineGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function minesProvider()
    {
        return [[1], [4], [10]];
    }

    public function testFieldSize()
    {
        $mg = new MineGenerator(2, 2);
        $this->assertCount(2, $mg->getFieldWithMines());
        $this->assertCount(2, $mg->getFieldWithMines()[0]);
        $this->assertCount(2, $mg->getFieldWithMines()[1]);
    }

    /**
     * testInvalidFieldSizeç
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidFieldSize()
    {
        $mg = new MineGenerator(2, 2, 5);
    }

    /**
     * @dataProvider minesProvider
     */
    public function testFieldHasMines($mines)
    {
        $total = 0;
        $mg = new MineGenerator($mines, $mines, $mines);
        $mineField = $mg->getFieldWithMines();
        foreach ($mineField as $col) {
            foreach ($col as $row) {
                if ($row === 'M') {
                    $total++;
                }
            }
        }

        $this->assertEquals($mines, $total);
    }
}
