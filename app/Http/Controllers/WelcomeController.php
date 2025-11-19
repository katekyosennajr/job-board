<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch real approved jobs from database
        $featuredJobs = Job::where('status', 'approved')
            ->with('company')
            ->latest()
            ->limit(4)
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company' => $job->company->name ?? 'Unknown Company',
                    'location' => $job->location,
                    'salary' => $this->formatSalary($job->min_salary, $job->max_salary),
                ];
            });

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'featuredJobs' => $featuredJobs,
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    private function formatSalary($min, $max)
    {
        if (!$min && !$max) {
            return 'Tidak ditentukan';
        }
        if (!$min) {
            return 'Rp ' . $this->formatNumber($max);
        }
        if (!$max) {
            return 'Rp ' . $this->formatNumber($min);
        }
        return 'Rp ' . $this->formatNumber($min) . ' - ' . $this->formatNumber($max);
    }

    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'jt';
        }
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'rb';
        }
        return $number;
    }
}
