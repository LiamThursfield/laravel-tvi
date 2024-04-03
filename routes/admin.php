<?php

use App\Http\Controllers\Admin\CMS\LayoutController;
use App\Http\Controllers\Admin\CMS\MenuController;
use App\Http\Controllers\Admin\CMS\PageController;
use App\Http\Controllers\Admin\CMS\RedirectController;
use App\Http\Controllers\Admin\CMS\TemplateController;
use App\Http\Controllers\Admin\CRM\ContactController;
use App\Http\Controllers\Admin\CRM\FormController;
use App\Http\Controllers\Admin\CRM\FormSubmissionController;
use App\Http\Controllers\Admin\CRM\OrganisationUnitController;
use App\Http\Controllers\Admin\EDU\Announcement\AnnouncementController;
use App\Http\Controllers\Admin\EDU\Course\CourseController;
use App\Http\Controllers\Admin\EDU\Course\CoursePurchaseController;
use App\Http\Controllers\Admin\EDU\Label\LabelController;
use App\Http\Controllers\Admin\EDU\Lecture\LectureController;
use App\Http\Controllers\Admin\EDU\Programme\ProgrammeController;
use App\Http\Controllers\Admin\EDU\Section\SectionController;
use App\Http\Controllers\Admin\EDU\Webinar\WebinarController;
use App\Http\Controllers\Admin\EmailPreviewController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group([
    'as' => 'email.preview.',
    'prefix' => 'email/preview'
], function () {
    Route::get('/', [EmailPreviewController::class, 'index'])->name('index');
    Route::get('/{email}', [EmailPreviewController::class, 'show'])->name('show');
});

Route::group([
    'as' => 'cms.',
    'prefix' => 'cms'
], function () {
    Route::resource('layouts', LayoutController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('pages', PageController::class);
    Route::resource('redirects', RedirectController::class)
        ->parameter('redirects', 'cms_redirect');
    Route::resource('templates', TemplateController::class);
});

Route::group([
    'as' => 'crm.',
    'prefix' => 'crm'
], function () {
    Route::resource('contacts', ContactController::class);
    Route::resource('form-submissions', FormSubmissionController::class)->only([
        'index', 'show'
    ]);
    Route::resource('forms', FormController::class);
    Route::resource('organisation-units', OrganisationUnitController::class);
});

Route::group([
    'as' => 'edu.',
    'prefix' => 'edu'
], function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::patch('/announcements/publish/{announcement}', [AnnouncementController::class, 'publish'])
        ->name('announcements.publish');

    Route::resource('programmes', ProgrammeController::class);
    Route::get('/programmes/preview/{programme}', [ProgrammeController::class, 'preview'])
        ->name('programmes.preview');
    Route::patch('/programmes/publish/{programme}', [ProgrammeController::class, 'publish'])
        ->name('programmes.publish');

    Route::resource('courses', CourseController::class);
    Route::get('/courses/preview/{course}', [CourseController::class, 'preview'])->name('courses.preview');
    Route::patch('/courses/publish/{course}', [CourseController::class, 'publish'])->name('courses.publish');
    Route::resource('course-purchases', CoursePurchaseController::class)
        ->only(['index', 'show']);

    Route::resource('sections', SectionController::class);
    Route::resource('lectures', LectureController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('webinars', WebinarController::class);
    Route::patch('/webinars/publish/{webinar}', [WebinarController::class, 'publish'])
        ->name('webinars.publish');
});

Route::get('/file-manager', [FileManagerController::class, 'index'])
    ->name('file_manager.index')
    ->middleware(['can:view file_manager']);

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile'
], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});

Route::group([
    'as' => 'settings.',
    'prefix' => 'settings'
], function() {
    Route::get('/{group}/edit', [SettingController::class, 'edit'])->name('edit');
    Route::put('/{group}', [SettingController::class, 'update'])->name('update');
});

Route::resource('users', UserController::class);

/** Fallback admin route - ensures Auth() calls work as expected in the exception handler */
Route::fallback(function () {
    abort(404);
});
