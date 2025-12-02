<?php

namespace App\Factories;

class ImportantNote implements NoteTypeInterface
{
    public function build(array $data): array
    {
        return [
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'type'    => 'important',
            'is_important' => 1,
            'reminder_date' => null,
            'metadata' => json_encode([
                'service' => 'evernote',
                'export_style' => 'intermediate'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function buildForUpdate(array $data): array
    {
        return [
            'title'   => $data['title'],
            'content' => $data['content'],
            'type'    => 'important',
            'is_important' => 1,
            'reminder_date' => null,
            'updated_at' => now(),
        ];
    }
}

