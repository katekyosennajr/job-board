<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;
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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => auth()->user(),
            ],
        ]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('company')->group(function () {
        Route::resource('jobs', JobController::class);
    });

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/jobs/{id}/approve', [AdminJobController::class, 'approve'])->name('jobs.approve');
        Route::post('/jobs/{id}/reject', [AdminJobController::class, 'reject'])->name('jobs.reject');
    });

    Route::middleware('role:candidate')->group(function () {
        Route::get('/candidate/dashboard', [DashboardController::class, 'index'])->name('candidate.dashboard');
    });
});

require __DIR__.'/auth.php';
