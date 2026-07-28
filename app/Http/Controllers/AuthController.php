<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $validated = $request->validate(
        [
            'username' => 'required|email',
            'password' => ['required', 'min:3', 'max:20',
                            Password::min(3) 
                                ->max(20)
                                ->mixedCase()
                                ->symbols()
                            ],
        ]);

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required', 'confirmed',
                            Password::min(3)
                            ->max(20)
                            ->mixedCase()
                            ->symbols()
            ]
        ]);

        return redirect()->route('home');
    }

    // public function val(Request $request)
    // {
    //     $validated = $request->validate([
    //         'total_students' => ['different:class'],
    //         'class_date' => ['after:today']
    //     ]);
    // }
}
