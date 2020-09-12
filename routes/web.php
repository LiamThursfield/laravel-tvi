<?php

use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'verify' => config('auth.user_verification')
]);


// Website Routes
Route::group([
    'as'        => 'website.',
], function() {

    Route::get('/', [HomeController::class, 'index'])->name('index');

});
