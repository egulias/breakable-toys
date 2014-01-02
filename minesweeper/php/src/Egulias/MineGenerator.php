<?php

namespace Egulias;

class MineGenerator implements MineGeneratorStrategy
{
    protected $mineField = array();
    protected $xSize;
    protected $ySize;

    public function __construct($xSize, $ySize, $mines = 1)
    {
        $this->xSize = (int) $xSize;
        $this->ySize = (int) $ySize;
        $size = $this->ySize * $this->xSize;
        $field = array_fill(0, $this->xSize, array_fill(0, $this->ySize, 0));

        if ($size < $mines) {
            throw new \InvalidArgumentException('Too many mines');
        }

        $this->mineField = $this->generateMines($field, $mines);
    }

    public function getFieldWithMines()
    {
        return $this->mineField;
    }

    protected function generateMines(array $field, $mines)
    {
        do {
            $y = rand(0, $this->ySize - 1);
            $x = rand(0, $this->xSize - 1);
        } while ($field[$y][$x] === 'M');

        $field[$y][$x] = 'M';
        $mines--;
        if ($mines) {
            return $this->generateMines($field, $mines);
        }
        return $field;
    }
}
