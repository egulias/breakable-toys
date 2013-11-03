<?php

namespace Egulias;

class Minesweeper
{
    protected $field;

    public function __construct(array $field)
    {
        $this->field = $field;
        $this->parsedField = $field;
    }

    public function sweep()
    {
        foreach ($this->field as $i => $row) {
            foreach ($row as $j => $column) {
                if ($column !== 'X') {
                    continue;
                }
                $this->markDiagonal($j, $i);
                $this->markSides($j, $i);
            }
        }
        return $this->parsedField;
    }

    protected function markSides($x, $y)
    {
        if (isset($this->parsedField[$y-1][$x])) {
            $this->parsedField[$y-1][$x]++;
        }
        if (isset($this->parsedField[$y+1][$x])) {
            $this->parsedField[$y+1][$x]++;
        }
        if (isset($this->parsedField[$y][$x-1])) {
            $this->parsedField[$y][$x-1]++;
        }
        if (isset($this->parsedField[$y][$x+1])) {
            $this->parsedField[$y][$x+1]++;
        }
    }

    protected function markDiagonal($x, $y)
    {
        if (isset($this->parsedField[$y-1][$x-1])) {
            $this->parsedField[$y-1][$x-1]++;
        }
        if (isset($this->parsedField[$y+1][$x+1])) {
            $this->parsedField[$y+1][$x+1]++;
        }
        if (isset($this->parsedField[$y+1][$x-1])) {
            $this->parsedField[$y+1][$x-1]++;
        }
        if (isset($this->parsedField[$y-1][$x+1])) {
            $this->parsedField[$y-1][$x+1]++;
        }
    }
}
