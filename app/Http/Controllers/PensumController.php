<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePensumRequest;
use App\Http\Requests\UpdatePensumRequest;
use App\Models\Pensum;

class PensumController extends Controller
{
    public function index()
    {
        $pensum = Pensum::with('subjects')->where('career_id', auth()->user()->profile->career_id)->first();
        return view('pensum', compact('pensum'));
    }
}
