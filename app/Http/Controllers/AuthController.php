<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view("auth.login");
    }
    public function showSignUpForm()
    {
        return view("auth.signup");
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|password_match:password_confirmation',
        ]);
        $role = 'tenant';
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);
        return redirect()->route('login')->with('success', 'Registration successful! Please Login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin' || $user->role === 'landlord') {
                return redirect('/dashboard');
            } else if ($user->role === 'tenant') {
                return redirect('/');
            }
        }
        return back()->with('error', 'Invalid emails or password');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
