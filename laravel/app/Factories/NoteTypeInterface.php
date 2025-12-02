<?php

namespace App\Factories;

interface NoteTypeInterface
{
    public function build(array $data): array;
    public function buildForUpdate(array $data): array;

}
