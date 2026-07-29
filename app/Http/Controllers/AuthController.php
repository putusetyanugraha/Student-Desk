<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectToLogin()
    {
        return redirect()->route('login');
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
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()
            ->withInput()
            ->with(
                'error_messages',
                __('auth.failed')
            );
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],

            'email' => ['required', 'email', 'unique:users,email'],

            'password' => [
                'required',
                'confirmed',
                Password::min(3)
                    ->max(20)
                    ->mixedCase()
                    ->symbols(),
            ]
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // public function val(Request $request)
    // {
    //     $validated = $request->validate([
    //         'total_students' => ['different:class'],
    //         'class_date' => ['after:today']
    //     ]);
    // }
}
