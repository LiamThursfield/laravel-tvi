<?php

use App\Http\Controllers\Api\CMS\PageController;
use App\Http\Controllers\Api\CRM\FormSubmissionController;
use App\Http\Controllers\Api\EDU\CourseCheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/form-submission/{form}', [FormSubmissionController::class, 'store'])->name('form-submission.store');

Route::get('/page', [PageController::class, 'show'])->name('page');

Route::group([
    'as' => 'edu.',
    'prefix' => 'edu',
], function() {
    Route::group([
        'as' => 'courses.',
        'prefix' => 'courses',
    ], function() {
        Route::post('/{course}/checkout', CourseCheckoutController::class)->name('checkout');
    });
});