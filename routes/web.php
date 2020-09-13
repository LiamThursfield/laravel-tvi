<?php

use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Mail;
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

Route::get('/mail', function() {
    Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
    {
        $message->to('liam3006@hotmail.co.uk')->from('test@liamthursfield.com');
    });
});
