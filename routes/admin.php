<?php

use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/file-manager', [FileManagerController::class, 'index'])
    ->name('file_manager.index')
    ->middleware(['can:view file_manager']);

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index')
    ->middleware('can:view profile');

Route::resource('users', UserController::class)->only([
    'destroy',
    'index'
]);
