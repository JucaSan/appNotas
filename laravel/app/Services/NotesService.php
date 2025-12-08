<?php 

namespace App\Services;

use App\BO\NotesBO;
use App\Repositories\RepoData\NotesRepoData;
use App\Repositories\RepoAction\NotesRepoAction;

class NotesService {

    protected $noteRD;
    protected $noteRA;
    protected $noteBO;

    public function __construct(
        NotesRepoData $noteRD,
        NotesRepoAction $noteRA,
        NotesBO $noteBO
        )
    {
        $this->noteRD = $noteRD;
        $this->noteRA = $noteRA;
        $this->noteBO = $noteBO;
    }

    public function listarNotas($filters)
    {
        $filters['columnas'] = "id,title,content,user_id,is_important,reminder_date,metadata,created_at,updated_at";
        return $this->noteRD->listar($filters);
    }

    public function obtenerNota($id, $user_id)
    {
        $filters['columnas'] = "id,title,content,user_id,is_important,reminder_date,metadata,created_at,updated_at";
        return $this->noteRD->obtener($id, $user_id, $filters);
    }

    public function agregarNota(array $data) 
    {
        $preparado = $this->noteBO->prepararParaCrear($data);
        return $this->noteRA->crear($preparado);
    }

    public function actualizarNota(int $id, array $data) 
    {
        $preparado = $this->noteBO->prepararParaActualizar($data);
        return $this->noteRA->actualizar($id, $preparado);
    }

    public function eliminarNota(int $id)
    {
        return $this->noteRA->eliminar($id);
    }
}