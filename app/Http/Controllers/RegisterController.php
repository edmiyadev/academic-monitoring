<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(StoreRegisterRequest $request)
    {
        // dd($request->validated());

        User::create($request->validated());

        $isAuth = auth()->attempt($request->only('email', 'password'));

        if ($isAuth) {
            return redirect()->route('dashboard');
        }

    }
}
