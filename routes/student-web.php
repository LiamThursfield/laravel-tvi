<?php

use App\Http\Controllers\Student\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Student Web Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant student web routes for your application.
| This should only really be the login and registration routes.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');