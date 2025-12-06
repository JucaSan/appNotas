<?php 

namespace App\Services;

use App\Repositories\RepoData\NotesRepoData;

class NotesService {

    protected $noteRD;

    public function __construct(NotesRepoData $noteRD)
    {
        $this->noteRD = $noteRD;
    }

    public function listarNotas($filters) {
        return $this->noteRD->listar($filters);
    }

    public function obtenerNotas($id, $user_id) {
        return $this->noteRD->obtener($id, $user_id);
    }

}