<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobApprovalController;
use App\Http\Controllers\Candidate\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CompanyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WelcomeController::class, 'index']);

// Public pages
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Candidate Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Candidate-only routes
    Route::middleware('role:candidate')->group(function () {
        Route::get('/cv-builder', [DashboardController::class, 'cvBuilder'])->name('cv.builder');
    });

    Route::middleware('company')->group(function () {
        Route::get('/company/profile', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
        Route::patch('/company/profile', [CompanyProfileController::class, 'update'])->name('company.profile.update');
        Route::post('/company/profile', [CompanyProfileController::class, 'update']);
        
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::put('/jobs/{job}', [JobController::class, 'update']);
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
        Route::get('/jobs/{job}/applicants', [JobApplicationController::class, 'applicants'])->name('jobs.applicants');
        
        // Company-only routes
        Route::get('/talent-search', [CompanyController::class, 'talentSearch'])->name('talent.search');
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
