<?php

namespace Egulias;

class Minesweeper
{
    protected $field;
    protected $parsedField;
    protected $mineMarker;

    public function __construct(array $field, $mineMarker = 'X')
    {
        $this->field = $field;
        $this->parsedField = $field;
        $this->mineMarker = $mineMarker;
    }

    public function sweep()
    {
        foreach ($this->field as $i => $row) {
            foreach ($row as $j => $column) {
                if (!$this->isMine($j, $i)) {
                    continue;
                }
                $this->markDiagonal($j, $i);
                $this->markSides($j, $i);
            }
        }
        return $this->parsedField;
    }

    public function isMine($x, $y)
    {
        if ($this->field[$y][$x] === $this->mineMarker) {
            return true;
        }
        return false;
    }

    protected function markSides($x, $y)
    {
        if (isset($this->parsedField[$y-1][$x]) && !$this->isMine($x, $y-1)) {
            $this->parsedField[$y-1][$x]++;
        }
        if (isset($this->parsedField[$y+1][$x]) && !$this->isMine($x, $y+1)) {
            $this->parsedField[$y+1][$x]++;
        }
        if (isset($this->parsedField[$y][$x-1]) && !$this->isMine($x-1, $y)) {
            $this->parsedField[$y][$x-1]++;
        }
        if (isset($this->parsedField[$y][$x+1]) && !$this->isMine($x+1, $y)) {
            $this->parsedField[$y][$x+1]++;
        }
    }

    protected function markDiagonal($x, $y)
    {
        if (isset($this->parsedField[$y-1][$x-1]) && !$this->isMine($x-1, $y-1)) {
            $this->parsedField[$y-1][$x-1]++;
        }
        if (isset($this->parsedField[$y+1][$x+1]) && !$this->isMine($x+1, $y+1)) {
            $this->parsedField[$y+1][$x+1]++;
        }
        if (isset($this->parsedField[$y+1][$x-1]) && !$this->isMine($x-1, $y+1)) {
            $this->parsedField[$y+1][$x-1]++;
        }
        if (isset($this->parsedField[$y-1][$x+1]) && !$this->isMine($x+1, $y-1)) {
            $this->parsedField[$y-1][$x+1]++;
        }
    }
}
