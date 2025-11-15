<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'approved')->get();

        return inertia('Candidate/Dashboard', [
            'jobs' => $jobs
        ]);
    }
}
