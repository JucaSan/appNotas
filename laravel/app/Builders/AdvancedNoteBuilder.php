<?php

namespace App\Builders;

use Illuminate\Support\Facades\DB;

class AdvancedNoteBuilder implements NoteExportBuilderInterface
{
    private array $data = [];

    public function reset(): void
    {
        $this->data = [];
    }

    public function addBasicInfo(array $note): void
    {
        $this->data['title'] = $note['title'];
    }

    public function addAuthor(array $note): void
    {
        $author = DB::table('users')->where('id', $note['user_id'])->value('name');
        $this->data['author'] = $author;
    }

    public function addTimestamps(array $note): void
    {
        $this->data['created_at'] = $note['created_at'];
        $this->data['updated_at'] = $note['updated_at'];
        $this->data['was_edited'] = $note['created_at'] != $note['updated_at'];
    }

    public function addFlags(array $note): void
    {
        $this->data['is_important'] = (bool) $note['is_important'];
        $this->data['has_reminder'] = !is_null($note['reminder_date']);
    }

    public function getResult(): array
    {
        return $this->data;
    }
}
