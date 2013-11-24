<?php

namespace Tests;

use Egulias\MineField;

class MineFieldTest extends \PHPUnit_Framework_TestCase
{
    public function minesProvider()
    {
        return [[1], [4], [10]];
    }

    public function testFieldSize()
    {
        $mineField = new MineField(2, 2);
        $this->assertCount(2, $mineField->getArrayCopy());
        $this->assertCount(2, $mineField->getArrayCopy()[0]);
        $this->assertCount(2, $mineField->getArrayCopy()[1]);
    }

    /**
     * @dataProvider minesProvider
     */
    public function testFieldHasMines($mines)
    {
        $total = 0;
        $mineField = new MineField(4, 4, $mines);
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
