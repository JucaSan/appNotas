<?php 

namespace App\Services;

use App\BO\AuthBO;
use App\Repositories\RepoAction\AuthRepoAction;
use App\Repositories\RepoData\AuthRepoData;

class AuthService 
{
    protected $authRD;
    protected $authBO;
    protected $authRA;

    public function __construct(
        AuthRepoData $authRD,
        AuthBO $authBO,
        AuthRepoAction $authRA
        )
    {
        $this->authRD = $authRD;
        $this->authBO = $authBO;
        $this->authRA = $authRA;
    }

    public function obtenerUsuario($userId) 
    {
        return $this->authRD->obtener($userId);
    }

    public function registrarUsuario(array $data): int 
    {
        $preparado = $this->authBO->prepararParaCrear($data);
        return $this->authRA->crearUsuario($preparado);
    }

    public function actualizarUsuario(int $id, array $data)
    {
        $preparado = $this->authBO->prepararParaEditar($data);
        return $this->authRA->actualizarUsuario($id, $preparado);
    }

}
