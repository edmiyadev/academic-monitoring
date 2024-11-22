<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePensumRequest;
use App\Http\Requests\UpdatePensumRequest;
use App\Models\Pensum;

class PensumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePensumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pensum $pensum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pensum $pensum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePensumRequest $request, Pensum $pensum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pensum $pensum)
    {
        //
    }
}
