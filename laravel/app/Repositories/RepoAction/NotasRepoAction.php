<?php

namespace App\Repositories\RepoAction;

use Illuminate\Support\Facades\DB;


class NotasRepoAction 
{
    public function crear(array $data) 
    {
        return DB::table('notes')->insertGetId($data);
    }

    public function actualizar(int $id, array $data) 
    {
        return DB::table('notes')->where('id', $id)->update($data);
    }

    public function eliminar(int $id, int $userId)
    {
        return DB::table('notes')
            ->where('id', $id)
            ->update([
                'is_active'  => false,
                'updated_at' => now(),
                'updated_by' => $userId,
            ]);
    }

}