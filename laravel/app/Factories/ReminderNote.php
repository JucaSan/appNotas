<?php

namespace App\Factories;

class ReminderNote implements NoteTypeInterface
{
    public function build(array $data): array
    {
        return [
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'type'    => 'reminder',
            'is_important' => 0,
            'reminder_date' => $data['reminder_date'],
            'metadata' => json_encode([
                'service' => 'evernote',
                'export_style' => 'advanced'
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
            'type'    => 'reminder',
            'is_important' => 0,
            'reminder_date' => $data['reminder_date'],
            'updated_at' => now(),
        ];
    }
}

