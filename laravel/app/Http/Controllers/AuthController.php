<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index() {
        return view('auth.login');
    }


    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('notes.index');
        }

        return back()->with('error', 'Credenciales incorrectas');
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
        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        Auth::loginUsingId($userId);

        return redirect()->route('notes.index')->with('success', 'Registrado e iniciado sesión correctamente');
    }
}
