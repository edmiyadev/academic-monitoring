<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('message', 'incorrect credentials');
        }

        return redirect()->route('dashboard');
    }
}
