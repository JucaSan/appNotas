<?php

namespace App\Repositories\RepoAction;

use Illuminate\Support\Facades\DB;


class NotesRepoAction 
{
    public function crear(array $data) 
    {
        return DB::table('notes')->insertGetId($data);
    }

    public function actualizar(int $id, array $data) 
    {
        return DB::table('notes')->where('id', $id)->update($data);
    }

    public function eliminar(int $id)
    {
        return DB::table('notes')->where('id', $id)->delete();
    }
}