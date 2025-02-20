<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::prefix('doctor')->namespace('Doctor')->group(function(){
        Route::get('/', 'IndexController')->name('admin.doctor.index');
    });

    Route::prefix('patient')->namespace('Patient')->group(function(){
        Route::get('/', 'IndexController')->name('admin.patient.index');
    });
});

require __DIR__.'/auth.php';
