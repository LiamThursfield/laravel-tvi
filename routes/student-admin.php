<?php

use App\Http\Controllers\Student\Admin\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/courses/{course}', [HomeController::class, 'show'])->name('show');
Route::patch('/lectures/{lecture}/complete', [HomeController::class, 'completeLecture'])
    ->name('lectures.complete');
Route::get('/lectures/{lecture}/downloadPdf', [HomeController::class, 'downloadLecturePDFs'])
    ->name('lectures.downloadPdf');
