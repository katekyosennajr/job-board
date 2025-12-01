<?php

namespace App\Http\Controllers;

use App\Exports\JobsExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'company') {
            $jobs = Job::where('user_id', auth()->id())->latest()->get();
        } else {
            $jobs = Job::where('status', 'approved')->latest()->paginate(15);
        }

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return Inertia::render('Jobs/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
        ]);

        $job = Job::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'job_type' => $validated['job_type'],
            'kategori' => $validated['kategori'],
            'min_salary' => $validated['min_salary'] ?? 0,
            'max_salary' => $validated['max_salary'] ?? 0,
            'company_id' => auth()->id(),
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);
        // Notifikasi ke admin
        foreach (\App\Models\User::where('role', 'admin')->get() as $admin) {
            $admin->notify(new \App\Notifications\JobPostedNotification($job));
        }

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diposting!');
    }

    public function edit(Job $job)
    {
        // Only company that owns this job can edit
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        return Inertia::render('Jobs/Edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        // Only company that owns this job can update
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diperbarui!');
    }

    public function destroy(Job $job)
    {
        // Only company that owns this job can delete
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job berhasil dihapus!');
    }

    public function show($id)
    {
        $job = Job::with('company')->findOrFail($id);

        return Inertia::render('Jobs/Show', [
            'job' => $job,
        ]);
    }

    // Export jobs to Excel
    public function exportJobs()
    {
        return Excel::download(new JobsExport, 'jobs.xlsx');
    }
}
