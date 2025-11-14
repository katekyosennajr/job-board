<?php

namespace App\Http\Controllers;

use App\Models\Job;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'pending')->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function approve($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['status' => 'approved']);
        return back();
    }

    public function reject($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['status' => 'rejected']);
        return back();
    }
}
