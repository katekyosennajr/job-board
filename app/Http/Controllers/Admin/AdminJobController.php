<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'pending')->get();
        return inertia('Admin/Jobs/Index', [
            'jobs' => $jobs
        ]);
    }

    public function approve($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return back()->with('success', 'Job approved successfully');
    }

    public function reject($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return back()->with('success', 'Job rejected successfully');
    }

}
