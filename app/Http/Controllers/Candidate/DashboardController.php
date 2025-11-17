<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'approved')->get();

        return inertia('Dashboard', [
            'auth' => [
                'user' => auth()->user(),
            ],
            'jobs' => $jobs,
        ]);
    }
}
