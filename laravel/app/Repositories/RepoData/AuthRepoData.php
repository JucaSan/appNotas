<?php 

namespace App\Repositories\RepoData;

use Illuminate\Support\Facades\DB;

class AuthRepoData
{
    public function obtener($userId) 
    {
        return DB::table('users')
            ->where('id', $userId)
            ->first();
    }
}