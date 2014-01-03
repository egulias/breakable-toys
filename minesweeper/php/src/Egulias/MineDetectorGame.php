<?php

namespace Egulias;

use Egulias\Minesweeper;
use Egulias\MineExplodedException;
use Egulias\MineGeneratorStrategy;
use Egulias\GameWinException;

class MineDetectorGame
{
    protected $cleared = [];
    protected $markedMines = [];
    protected $minesweeper;
    protected $mines;

    public function __construct(MineGeneratorStrategy $mg)
    {
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
        $this->markedMines[$y][$x] = $mark;
        $this->checkWinCondition();
        return $this->markedMines;
    }

    protected function checkWinCondition()
    {
        if ($this->markedMines == $this->minesweeper->getMines() && $this->undiscovered === $this->minesCount) {
            throw new GameWinException('You Win!');
        }
    }

    protected function clearAdjacent($x, $y)
    {
        if (isset($this->cleared[$y][$x])) {
            return;
        }
        $this->cleared[$y][$x] = true;
        $this->undiscovered--;
        $posibleWays = [[$y-1, $x], [$y+1, $x], [$y, $x-1], [$y, $x+1]];
        foreach ($posibleWays as $way) {
            if (!isset($this->fieldSweeped[$way[0]][$way[1]])) {
                continue;
            }
            if ($this->fieldSweeped[$way[0]][$way[1]]) {
                $this->cleared[$way[0]][$way[1]] = true;
                $this->undiscovered--;
                continue;
            }
            $this->clearAdjacent($way[1], $way[0]);
        }
    }

    private function initGame($mineField)
    {
        $this->minesweeper = new Minesweeper($mineField, 'M');
        $this->fieldSweeped = $this->minesweeper->sweep();
        $this->undiscovered = count($this->fieldSweeped, COUNT_RECURSIVE) - count($this->fieldSweeped);
        $this->minesCount = $this->minesweeper->getMinesFound();
    }
}
