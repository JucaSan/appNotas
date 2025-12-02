<?php

namespace App\Builders;

class SimpleNoteBuilder implements NoteExportBuilderInterface
{
    private array $data = [];

    public function reset(): void
    {
        $this->data = [];
    }

    public function addBasicInfo(array $note): void
    {
        $this->data['title'] = $note['title'];
        $this->data['description'] = $note['content'];
    }

    public function addAuthor(array $note): void {}
    public function addTimestamps(array $note): void {}
    public function addFlags(array $note): void {}

    public function getResult(): array
    {
        return $this->data;
    }
}
