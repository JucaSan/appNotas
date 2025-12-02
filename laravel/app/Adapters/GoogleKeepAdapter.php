<?php

namespace App\Adapters;

class GoogleKeepAdapter implements NoteSyncAdapterInterface
{
    public function transform(array $note): array
    {
        return [
            'usuario_id' => $note['user_id'],
            'title'      => $note['title'],
            'note'       => $note['content'],
            'date'       => $note['created_at'],
        ];
    }
}
