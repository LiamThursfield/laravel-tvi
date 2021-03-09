<?php

use App\Http\Controllers\Api\CMS\PageController;
use App\Http\Controllers\Api\CRM\FormSubmissionController;
use Illuminate\Http\Request;
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

Route::post('/form-submission/{form}', [FormSubmissionController::class, 'store'])->name('api.form-submission.store');

Route::get('/page', [PageController::class, 'show'])->name('api.page');
