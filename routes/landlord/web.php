<?php

use App\Http\Controllers\Landlord\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landlord Web Routes
|--------------------------------------------------------------------------
|
| Here you can register the landlord web routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/
Route::group([
    'as'        => 'landlord.',
], function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});