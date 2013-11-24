<?php

namespace Egulias;

use Egulias\Minesweeper;
use Egulias\MineExplodedException;

class MineDetectorGame
{
    /**
     * minesweeper
     *
     * @var Minesweeper
     */
    protected $minesweeper;

    public function __construct($xSize, $ySize, $mines = 1)
    {
        $this->field = new MineField($xSize, $ySize, $mines);
        $this->minesweeper = new Minesweeper($this->field->getArrayCopy(), 'M');
        $this->field = $this->minesweeper->sweep();
    }

    public function clear($x, $y)
    {
        if ($this->minesweeper->isMine($y, $x)) {
            throw new MineExplodedException();
        }
        $this->clearZones($x, $y);
    }

    protected function clearZones($x, $y)
    {

    }

    public function getField()
    {
        return $this->field;
    }
}
