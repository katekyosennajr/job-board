<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobApprovalController;
use App\Http\Controllers\Candidate\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('company')->group(function () {
        Route::resource('jobs', JobController::class)->except(['show', 'index']);
        Route::get('/jobs/{job}/applicants', [JobApplicationController::class, 'applicants'])->name('jobs.applicants');
    });

    Route::post('/jobs/{id}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/my-applications', [JobApplicationController::class, 'myApplications'])->name('applications.my');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/jobs', [AdminJobController::class, 'index'])
            ->name('jobs.index');

        Route::get('/jobs/approval', [AdminJobApprovalController::class, 'index'])
            ->name('jobs.approval.index');

        Route::post('/jobs/{id}/approve', [AdminJobApprovalController::class, 'approve'])
            ->name('jobs.approval.approve');

        Route::post('/jobs/{id}/reject', [AdminJobApprovalController::class, 'reject'])
            ->name('jobs.approval.reject');

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');
    });
});

require __DIR__.'/auth.php';
