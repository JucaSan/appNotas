<?php

namespace App\Repositories\RepoAction;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepoAction 
{
    public function crearUsuario(array $data): int
    {
        return DB::table('users')->insertGetId($data);
    }

    public function actualizarUsuario(int $id, array $data): int 
    {
        return DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

}