<?php

use App\Http\Controllers\AdminApi\FileManager\FileManagerDirectoryController;
use App\Http\Controllers\AdminApi\FileManager\FileManagerFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'as' => 'file-manager.',
    'prefix' => 'file-manager'
], function() {
    Route::get('/directories', [FileManagerDirectoryController::class, 'index'])->name('directories.index');
    Route::post('/directories', [FileManagerDirectoryController::class, 'store'])->name('directories.store');

    Route::get('/files', [FileManagerFileController::class, 'index'])->name('files.index');
});
