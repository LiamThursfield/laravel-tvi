<?php

use App\Http\Controllers\Admin\CMS\TemplateController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group([
    'as' => 'cms.',
    'prefix' => 'cms'
], function() {
    Route::resource('templates', TemplateController::class);
});

Route::get('/file-manager', [FileManagerController::class, 'index'])
    ->name('file_manager.index')
    ->middleware(['can:view file_manager']);

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile'
], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});

Route::resource('users', UserController::class);

/** Fallback admin route - ensures Auth() calls work as expected in the exception handler */
Route::fallback(function () {
    abort(404);
});
