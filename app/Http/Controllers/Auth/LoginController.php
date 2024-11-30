<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        if (! auth()->attempt($request->only('email', 'password'))) {
            return back()->with('message', 'incorrect credentials');
        }

        return redirect()->route('dashboard');
    }
}
