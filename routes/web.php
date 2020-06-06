<?php

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


// App Routes
Route::group([
    'as'          => 'app.',
    'namespace'     => 'App',
], function() {

    Route::get('/', 'HomeController@index')->name('index');

});


// Admin Routes
Route::group([
    'middleware'    => 'auth',
    'as'            => 'admin.',
    'namespace'     => 'Admin',
    'prefix'        => 'admin',
], function () {

    Route::get('/', 'HomeController@index')->name('index');

});
