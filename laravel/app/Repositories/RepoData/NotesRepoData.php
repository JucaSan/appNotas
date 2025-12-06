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
        $columnas = $this->rh->obtenerColumnas();
        $query = DB::table('notes')->select($columnas);

        $filtros = $this->rh->obtenerFiltros($filters);
        foreach($filtros as $f) {
            $query->where($f[0], $f[1], $f[2]);
        }

        $query->where('user_id', $filters['user_id']);

        [$columna, $direccion] = $this->rh->obtenerOrden($filters);
        $query->orderBy($columna, $direccion);

        return $query->get();
    }

    public function obtener($id, $user_id) {
        
        $columnas = $this->rh->obtenerColumnas();

        return DB::table('notes')
            ->select($columnas)
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
    }
}