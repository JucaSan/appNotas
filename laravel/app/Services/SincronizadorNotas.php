<?php

namespace App\Services;

use App\Adapters\EvernoteAdapter;
use App\Adapters\GoogleKeepAdapter;

class SincronizadorNotas
{
    public static function enviar(array $note)
    {
        $metadata = json_decode($note['metadata'], true) ?? [];
        $service = $metadata['service'] ?? 'google';

        switch ($service) {
            case 'evernote':
                $adapter = new EvernoteAdapter();
                break;

            case 'google':
                $adapter = new GoogleKeepAdapter();
                break;
        }

        $data = $adapter->transform($note);

        return $data;
    }
}
