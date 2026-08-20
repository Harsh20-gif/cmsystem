<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

// Guest-only
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [Admin\AuthController::class, 'login'])->name('login.submit');
});

// Authenticated
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('course-categories', Admin\CourseCategoryController::class);
    Route::resource('courses', Admin\CourseController::class);
    Route::resource('courses.modules', Admin\CourseModuleController::class)->shallow();
    Route::resource('courses.faqs', Admin\CourseFaqController::class)->shallow();

    Route::resource('trainings', Admin\TrainingController::class);

    Route::resource('companies', Admin\CompanyController::class);
    Route::resource('students', Admin\StudentController::class);
    Route::resource('placements', Admin\PlacementController::class);

    Route::resource('gallery-albums', Admin\GalleryAlbumController::class);
    Route::resource('gallery-albums.images', Admin\GalleryImageController::class)->shallow();

    Route::resource('team-members', Admin\TeamMemberController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('branches', Admin\BranchController::class);

    Route::get('/enquiries', [Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{enquiry}', [Admin\EnquiryController::class, 'show'])->name('enquiries.show');
    Route::patch('/enquiries/{enquiry}/status', [Admin\EnquiryController::class, 'updateStatus'])->name('enquiries.update_status');
    Route::delete('/enquiries/{enquiry}', [Admin\EnquiryController::class, 'destroy'])->name('enquiries.destroy');

    Route::get('/newsletters', [Admin\NewsletterController::class, 'index'])->name('newsletters.index');
    Route::get('/newsletters/export', [Admin\NewsletterController::class, 'export'])->name('newsletters.export');
    Route::delete('/newsletters/{newsletter}', [Admin\NewsletterController::class, 'destroy'])->name('newsletters.destroy');

    Route::resource('pages', Admin\PageController::class);

    Route::get('/settings', [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    Route::get('/media', [Admin\MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [Admin\MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{medium}', [Admin\MediaController::class, 'destroy'])->name('media.destroy');
});

Route::get('/', fn () => redirect()->route('admin.login'));
