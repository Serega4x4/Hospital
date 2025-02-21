<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('hospital');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:superadmin|admin')
    ->prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {

        Route::prefix('doctor')
            ->namespace('Doctor')
            ->group(function () {
                Route::get('/', 'IndexController')->name('admin.doctor.index');
                Route::get('/create', 'CreateController')->name('admin.doctor.create');
                Route::post('/create', 'StoreController')->name('admin.doctor.store');
                Route::get('/{doctor}', 'ShowController')->name('admin.doctor.show');
                Route::get('/{doctor}/edit', 'EditController')->name('admin.doctor.edit');
                Route::put('/{doctor}', 'UpdateController')->name('admin.doctor.update');
                Route::delete('/{doctor}', 'DestroyController')->name('admin.doctor.destroy');
            });

        Route::prefix('patient')
            ->namespace('Patient')
            ->group(function () {
                Route::get('/', 'IndexController')->name('admin.patient.index');
            });

        Route::prefix('administrator')
            ->namespace('Administrator')
            ->group(function () {
                Route::get('/', 'IndexController')->name('admin.administrator.index');
                Route::get('/create', 'CreateController')->name('admin.administrator.create');
                Route::post('/create', 'StoreController')->name('admin.administrator.store');
                Route::get('/{administrator}', 'ShowController')->name('admin.administrator.show');
                Route::get('/{administrator}/edit', 'EditController')->name('admin.administrator.edit');
                Route::put('/{administrator}', 'UpdateController')->name('admin.administrator.update');
                Route::delete('/{administrator}', 'DestroyController')->name('admin.administrator.destroy');
            });
    });

require __DIR__ . '/auth.php';
