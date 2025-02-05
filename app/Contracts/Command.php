<?php

namespace App\Contracts;

interface Command
{
    public function execute(): void;
    public function undo();
    public function redo();
    public function getResponse(): array;

}
