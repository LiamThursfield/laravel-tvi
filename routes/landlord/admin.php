<?php

use App\Http\Controllers\Landlord\Admin\HomeController;
use App\Http\Controllers\Landlord\Admin\TenantController;
use App\Http\Controllers\Landlord\Admin\UserController;
use App\Http\Controllers\Landlord\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::resource('tenants', TenantController::class);

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile'
], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});

Route::resource('users', UserController::class);

/** Fallback admin route - ensures Auth() calls work as expected in the exception handler */
Route::fallback(function () {
    abort(404);
});
