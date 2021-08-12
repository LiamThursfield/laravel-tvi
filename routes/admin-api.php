<?php

use App\Http\Controllers\AdminApi\CMS\MenuController;
use App\Http\Controllers\AdminApi\CMS\TemplateController;
use App\Http\Controllers\AdminApi\CMS\UrlAvailableController;
use App\Http\Controllers\AdminApi\CRM\FormController;
use App\Http\Controllers\AdminApi\FileManager\FileManagerDirectoryController;
use App\Http\Controllers\AdminApi\FileManager\FileManagerFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'as' => 'cms.',
    'prefix' => 'cms'
], function() {
    Route::get('/menu', [MenuController::class, 'index'])->name('menus.index');

    Route::get('/template}', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/template/{template}', [TemplateController::class, 'show'])->name('templates.show');

    Route::get('/url/available', [UrlAvailableController::class, 'handle'])->name('urls.available');
});

Route::group([
    'as' => 'crm.',
    'prefix' => 'crm'
], function() {
    Route::get('/form', [FormController::class, 'index'])->name('forms.index');
});

Route::group([
    'as' => 'file-manager.',
    'prefix' => 'file-manager'
], function() {
    Route::get('/directories', [FileManagerDirectoryController::class, 'index'])->name('directories.index');
    Route::post('/directories', [FileManagerDirectoryController::class, 'store'])->name('directories.store');

    Route::get('/files', [FileManagerFileController::class, 'index'])->name('files.index');
    Route::post('/files', [FileManagerFileController::class, 'store'])->name('files.store');
});
