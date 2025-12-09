<?php

namespace App\Builders;

use Illuminate\Support\Facades\DB;

class NotaIntermediaBuilder implements NotaExportBuilderInterface
{
    private array $data = [];

    public function reset(): void
    {
        $this->data = [];
    }

    public function addBasicInfo(array $note): void
    {
        $this->data['title'] = $note['title'];
        $this->data['description'] = $note['content'];
    }

    public function addAuthor(array $note): void
    {
        $author = DB::table('users')->where('id', $note['user_id'])->value('name');
        $this->data['author'] = $author;
    }

    public function addTimestamps(array $note): void
    {
        $this->data['created_at'] = $note['created_at'];
    }

    public function addFlags(array $note): void {}

    public function getResult(): array
    {
        return $this->data;
    }
}
