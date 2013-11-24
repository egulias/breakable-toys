<?php

namespace Egulias;

use \ArrayObject;

class MineField extends ArrayObject
{
    public function __construct($xSize, $ySize, $mines = 1)
    {
        $this->xSize = (int) $xSize;
        $this->ySize = (int) $ySize;
        $field = array_fill(0, $this->xSize, array_fill(0, (int)$this->ySize, 0));
        $field = $this->generateMines($field, $mines);
        parent::__construct($field);

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
