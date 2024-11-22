<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->profile_complete) {
            return redirect()->route('dashboard');
        }
        return view('profile');
    }

    public function store(Request $request)
    {
        $user = auth()->user()->profile()->create([
            'educational_level' => $request['educational-level'],
            'educational_institution' => $request['educational-institution'],
            'career' => $request['career'],
        ]);
        auth()->user()->update([
            'profile_complete' => true,
        ]);

        return redirect()->route('dashboard');
    }
}
