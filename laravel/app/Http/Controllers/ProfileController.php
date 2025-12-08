<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function index() {
        try {
            $userId = Auth::id();
            $user = $this->service->obtenerUsuario($userId);

            return view('auth.profile', compact('user'));
        } catch(\Exception $e){
            return back()->with('error', "Algo ha salido mal al acceder a tu perfil");
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            $userId = Auth::id();
            $user = $this->service->obtenerUsuario($userId);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'La contraseña actual no es correcta'
                ]);
            }

            $this->service->actualizarUsuario($userId, [
                'password' => $request->password,
            ]);

            return back()->with('success', 'Contraseña actualizada correctamente');

        } catch(\Exception $e) {
            return back()->with('error', 'Hubo un error al cambiar la contraseña');
        }
    }

}
