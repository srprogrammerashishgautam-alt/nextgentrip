<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FrontendController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }

    public function login()
    {
        return Inertia::render('Login');
    }

    public function register()
    {
        return Inertia::render('Register');
    }

    public function forgotPassword()
    {
        return Inertia::render('ForgotPassword');
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }
}