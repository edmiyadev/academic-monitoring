<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->profile()->exists()) {
            return redirect()->route('dashboard');
        }

        return view('profile');
    }
}
