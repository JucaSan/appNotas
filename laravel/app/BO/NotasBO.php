<?php

namespace App\BO;

use App\Factories\NoteFactory;
use Illuminate\Http\Request;


class NotasBO
{
    public function prepararParaCrear(array $data): array
    {
        $fakeRequest = new Request($data);

        $noteType = NoteFactory::make( $fakeRequest );

        return $noteType->build([
            'title'         => $data['title'],
            'content'       => $data['content'],
            'user_id'       => $data['user_id'],
            'reminder_date' => $data['reminder_date'] ?? null,
        ]);
    }

    public function prepararParaActualizar(array $data): array
    {
        $fakeRequest = new Request($data);

        $noteType = NoteFactory::make( $fakeRequest );

        return $noteType->buildForUpdate([
            'title'         => $data['title'],
            'content'       => $data['content'],
            'reminder_date' => $data['reminder_date'] ?? null,
        ]);
    }
}
