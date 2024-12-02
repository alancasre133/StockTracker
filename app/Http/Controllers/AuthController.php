<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name|max:255',
            'correo' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('login')->with('success', 'Register Succesfull. Log In.');
    }
    

    // Mostrar formulario de inicio de sesión
    // Mostrar formulario de inicio de sesión
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar usando correo y contraseña
        if (Auth::attempt(['email' => $credentials['correo'], 'password' => $credentials['password']])) {
            return redirect()->route('stock_and_user.index')->with('success', 'You have been logged in.');
        }

        return back()->withErrors(['loginError' => 'Some field/s are incorrect.']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You Have been logged out.');
    }
}
