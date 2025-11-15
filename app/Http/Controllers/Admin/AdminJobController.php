<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Inertia\Inertia;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/Jobs/Index', [
            'jobs' => $jobs
        ]);
    }
}
