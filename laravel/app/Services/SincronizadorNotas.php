<?php

namespace App\Services;

use App\Adapters\EvernoteAdapter;
use App\Adapters\GoogleKeepAdapter;
use App\Adapters\NoteSyncAdapterInterface;

class SincronizadorNotas
{
    public function enviar(array $note): array 
    {
        $adapter = $this->revolveAdapter($note);
        return $adapter->transform($note);
    }

    private function revolveAdapter(array $note) :NoteSyncAdapterInterface
    {
        $metadata = json_decode($note['metadata'] ?? '{}', true);
        $service = $metadata['service'] ?? 'google';

        return match ($service) {
            'evernote' => new EvernoteAdapter(),
            'google'   => new GoogleKeepAdapter(),
            default    => new GoogleKeepAdapter(),
        };
    }
}
