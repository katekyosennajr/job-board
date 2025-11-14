<?php

namespace App\Http\Controllers;

use App\Models\Job;

class CandidateController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'approved')->get();
        return view('candidate.dashboard', compact('jobs'));
    }
}
