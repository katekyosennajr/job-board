<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    public function store($id)
    {
        $job = Job::findOrFail($id);

        $existing = JobApplication::where('job_id', $id)
            ->where('candidate_id', auth()->id())
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah melamar pekerjaan ini.');
        }

        JobApplication::create([
            'job_id' => $id,
            'candidate_id' => auth()->id(),
            'status' => 'pending',
            'cv_path' => null,
        ]);


        return back()->with('success', 'Berhasil melamar pekerjaan.');
    }

    public function myApplications()
    {
        $applications = JobApplication::where('candidate_id', auth()->id())
            ->with(['job.company'])
            ->latest()
            ->get();

        return Inertia::render('Candidate/Applications', [
            'applications' => $applications
        ]);
    }

    public function applicants($id)
    {
        $job = Job::findOrFail($id);

        $applicants = JobApplication::where('job_id', $id)
            ->with('candidate')
            ->get();

        return Inertia::render('Jobs/Applicants', [
            'job' => $job,
            'applicants' => $applicants
        ]);
    }
}
