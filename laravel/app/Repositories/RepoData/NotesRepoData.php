<?php 

namespace App\Repositories\RepoData;

use App\Repositories\RH\NotesRH;
use Illuminate\Support\Facades\DB;

class NotesRepoData 
{
    protected $rh;

    public function __construct(NotesRH $rh)
    {
        $this->rh = $rh;
    }

    public function listar($filters)
    {
        $query = DB::table('notes');

        $this->rh->obtenerColumnas($query, $filters['columnas']);
        $this->rh->obtenerFiltros($query, $filters);
        $this->rh->obtenerOrden($query, $filters);

        $query->where('user_id', $filters['user_id']);

        return $query->get();
    }

    public function obtener($id, $user_id, $filters)
    {
        $query = DB::table('notes');

        $this->rh->obtenerColumnas($query, $filters['columnas']);

        return $query
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
    }
}