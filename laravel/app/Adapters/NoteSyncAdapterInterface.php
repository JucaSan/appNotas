<?php

namespace App\Adapters;

interface NoteSyncAdapterInterface
{
    public function transform(array $note): array;
}
