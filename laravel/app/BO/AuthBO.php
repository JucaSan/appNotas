<?php

namespace App\BO;

use Illuminate\Support\Facades\Hash;

class AuthBO 
{

    public function prepararParaCrear(array $data)
    {
        return [
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function prepararParaEditar(array $data)
    {
        return [
            'password'   => Hash::make($data['password']),
            'updated_at' => now(),
        ];
    }

}