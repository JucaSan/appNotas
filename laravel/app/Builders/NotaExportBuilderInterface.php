<?php

namespace App\Builders;

interface NotaExportBuilderInterface
{
    public function reset(): void;
    public function addBasicInfo(array $note): void;
    public function addAuthor(array $note): void;
    public function addTimestamps(array $note): void;
    public function addFlags(array $note): void;
    public function getResult(): array;
}
