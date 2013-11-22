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

    public function __construct(Minesweeper $minesweeper)
    {
        $this->Minesweeper = $minesweeper;
        $this->minesweeper->sweep();
    }

    public function clear($x, $y)
    {
        if ($this->minesweeper->isMine($x, $y)) {
            throw new MineExplodedException();
        }
    }
}
