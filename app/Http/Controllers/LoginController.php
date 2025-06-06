<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('login');
    }

    


public function authenticate(Request $request)
{
    $credentials = $request->only('email', 'password');

    // 1) Intento como cliente
    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('cliente.citas');
    }

    // 2) Intento como doctor
    if (Auth::guard('doctor')->attempt($credentials)) {
        $request->session()->regenerate();
        // Redirigimos directamente al índice de “fechas” del doctor
        return redirect()->route('doctor.fechas.index');
    }

    // 3) Error en credenciales
    return back()->withErrors([
        'email' => 'Credenciales incorrectas o usuario no existe.',
    ])->onlyInput('email');
}


    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}

