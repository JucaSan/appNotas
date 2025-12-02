<?php

namespace App\Adapters;

class EvernoteAdapter implements NoteSyncAdapterInterface
{
    public function transform(array $note): array
    {
        return [
            'usuario_id' => $note['user_id'],
            'nota' => [
                'titulo'      => $note['title'],
                'descripcion' => $note['content'],
            ]
        ];
    }
}
