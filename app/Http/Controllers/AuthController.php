<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
