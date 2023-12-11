<?php

use App\Http\Controllers\Webhook\Stripe\StripeCourseCheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Webhook Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Webhook routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "webhook" middleware group.
|
*/

Route::group([
    'as' => 'stripe.',
    'prefix' => 'stripe',
], function() {
    Route::post('/course/checkout', StripeCourseCheckoutController::class)->name('course.checkout');
});

