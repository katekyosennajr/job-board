<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminJobApprovalController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sortBy', 'id');
        $sortDir = $request->get('sortDir', 'asc');

        $jobs = Job::orderBy($sortBy, $sortDir)->get();

        return Inertia::render('Admin/Jobs/Approval', [
            'jobs' => $jobs,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ]);
    }

    public function approve($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['approved' => true]);

        return back()->with('success', 'Job approved!');
    }

    public function reject($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return back()->with('success', 'Job rejected and removed!');
    }
}
