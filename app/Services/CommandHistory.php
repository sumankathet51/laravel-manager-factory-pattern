<?php

namespace App\Services;

use App\Contracts\Command;

class CommandHistory
{
    private $undoStack = [];
    private $redoStack = [];

    public function push(Command $command): void {
        $this->undoStack[] = $command;
        $this->redoStack = [];
    }

    public function undo(): void {
        if (empty($this->undoStack)) return;

        $command = array_pop($this->undoStack);
        $command->undo();
        $this->redoStack[] = $command;
    }

    public function redo(): void {
        if (empty($this->redoStack)) return;

        $command = array_pop($this->redoStack);
        $command->redo();
        $this->undoStack[] = $command;
    }

    public function clear(): void {
        foreach ($this->undoStack as $item) {
            $this->undo();
        }
    }
}
