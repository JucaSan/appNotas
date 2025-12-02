<?php

namespace App\Factories;

class NormalNote implements NoteTypeInterface
{
    public function build(array $data): array
    {
        return [
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'type'    => 'normal',
            'is_important' => 0,
            'reminder_date' => null,
            'metadata' => json_encode([
                'service' => 'google',
                'export_style' => 'simple'
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
            'type'    => 'normal',
            'is_important' => 0,
            'reminder_date' => null,
            'updated_at' => now(),
        ];
    }
}

