<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PensumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Livewire\PeriodSubjects;
use App\Models\Pensum;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
    // implementar logica de reidreccion si esta tutenticado al dashboard sino al login
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pensum', [PensumController::class, 'index'])->name('pensum');

    Route::get('/periods', function () {
        return view('periods');
    })->name('periods');

    Route::get('/period/{period}/subjects', function ($period){

        return view('period', ['periodId' => $period]);
    })->name('period.subjects');

});
