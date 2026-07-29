<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function redirectToLogin()
    {
        return redirect()->route('login.view');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email'    => $validated['username'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withInput($request->only('username'))->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed',
                            Password::min(8)
                                ->mixedCase()
                                ->symbols()
                                ->numbers()
            ],
        ]);

        User::create([
            'name'     => $validated['username'],
            'email'    => $validated['username'],
            'password' => $validated['password'], // otomatis di-hash krn cast 'hashed' di model
        ]);

        return redirect()->route('login.view')->with('status', 'Registrasi berhasil, silakan login.');
    }
}