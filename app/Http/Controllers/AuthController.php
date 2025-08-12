<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLogin(Request $request)
    {
        return view('auth.login');
    }
    public function showRegister(Request $request)
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {

    }
    public function register(Request $request)
    {
        $validated = $request-> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($validated);
        Auth::login($user);
        return redirect('/');
    }
}
