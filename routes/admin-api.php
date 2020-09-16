<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

// TODO: This is just a test route, remove once actual admin api routes are added
Route::get('/user', function (Request $request) {
    return $request->user();
});
