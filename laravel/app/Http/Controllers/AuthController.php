<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function index() {
        return view('auth.login');
    }


    public function login(Request $request) {

        try {
            $credentials = $request->validate([
                'email'    => 'required',
                'password' => 'required',
            ]);
    
            Auth::attempt($credentials);
            $request->session()->regenerate();
            return redirect()->route('notes.index');
        } catch(\Exception $e) {
            return back()->with('error', 'Credenciales incorrectas');
        }

    }


    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function registerForm() {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request) {
        try {
            $data = $request->validated();
    
            $userId = $this->service->registrarUsuario($data);
            Auth::loginUsingId($userId);
    
            return redirect()->route('notes.index')
                ->with('success', 'Registrado e iniciado sesión correctamente');
        } catch(\Exception $e) {
            return back()->with('Error', 'El usuario no se ha podido crear correctamente');
        }
    }
}
