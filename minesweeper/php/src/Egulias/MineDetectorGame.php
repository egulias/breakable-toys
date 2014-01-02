<?php

namespace Egulias;

use Egulias\Minesweeper;
use Egulias\MineExplodedException;
use Egulias\MineGenerator;
use Egulias\GameWinException;

class MineDetectorGame
{
    protected $cleared = [];
    protected $markedMines = [];
    protected $minesweeper;
    protected $mines;

    public function __construct($xSize = 1, $ySize = 1, $mines = 1)
    {
        $mg = new MineGenerator($xSize, $ySize, $mines);
        $this->mines;
        $this->initGame($mg->getFieldWithMines());
    }

    public function getClearedFields()
    {
        return $this->cleared;
    }

    public function getMarkedMines()
    {
        return $this->markedMines;
    }

    public function continueGame(array $mineField, $clearedFields = [], $marked = [])
    {
        $this->initGame($mineField);
        $this->cleared = $clearedFields;
        $this->markedMines = $marked;
        return ['clear' => $this->cleared, 'marked' => $this->markedMines];
    }

    public function clear($x, $y)
    {
        if ($this->minesweeper->isMine($y, $x)) {
            throw new MineExplodedException();
        }
        $this->clearAdjacent($x, $y);
        return $this->cleared;
    }

    public function markMine($x, $y, $mark = 'X')
    {
        $this->markedMines[[$y, $x]] = 'X';
        $this->checkWinCondition();
        return $this->markedMines;
    }

    protected function checkWinCondition()
    {
        if (count($this->markedMines) === $this->mines
            && count($this->cleared) === count($this->fieldSweeped)
        ) {
            $trueMines = $this->minesweeper->getMines();
            $found = 0;
            foreach ($this->markedMines as $mine => $mark) {
                if (isset($trueMines[$mine[0]][$mine[1]])) {
                    $found++;
                }
            }
            if ($found === count($trueMines)) {
                throw new GameWinException('You Win!');
            }
        }
    }

    protected function clearAdjacent($x, $y)
    {
        if (isset($this->cleared[$y][$x])) {
            return;
        }
        $this->cleared[$y][$x] = true;
        $posibleWays = [[$y-1, $x], [$y+1, $x], [$y, $x-1], [$y, $x+1]];
        foreach ($posibleWays as $way) {
            if (!isset($this->fieldSweeped[$way[0]][$way[1]])) {
                continue;
            }
            if ($this->fieldSweeped[$way[0]][$way[1]]) {
                $this->cleared[$way[0]][$way[1]] = true;
                continue;
            }
            $this->clearAdjacent($way[1], $way[0]);
        }
    }

    private function initGame($mineField)
    {
        $this->minesweeper = new Minesweeper($mineField, 'M');
        $this->fieldSweeped = $this->minesweeper->sweep();
    }
}
