<?php

use App\Http\Controllers\Website\EDU\CourseController;
use App\Http\Controllers\Website\EDU\CoursePurchasePaymentCheckoutController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Web Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant web routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

Auth::routes([
    'register'  => config('auth.user_register'),
    'verify'    => config('auth.user_verification')
]);


// Website Routes
Route::group([
    'as' => 'website.',
], function() {
    // If you want to use the CMS to control the home page - delete this route
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::group([
        'as' => 'edu.',
    ], function() {
        Route::group([
            'as' => 'courses.',
            'prefix' => 'courses',
        ], function() {
            Route::get('/{course:slug}', [CourseController::class, 'show'])->name('show');

            Route::get(
                '/{course:slug}/purchases/payments/{payment}/{timestamp}',
                CoursePurchasePaymentCheckoutController::class
            )->name('purchases.payments.checkout');
        });
    });
});

/** Fallback admin route - ensures Auth() calls work as expected in the exception handler */
Route::fallback([PageController::class, 'show']);
