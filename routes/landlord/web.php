<?php

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

Route::get('/', function () {
    return 'This is a landlord domain';
});