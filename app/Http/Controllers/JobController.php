<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('company_id', auth()->id())
            ->latest()
            ->paginate(10);

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
            'job_type' => 'required|in:full-time,part-time,contract,remote',
            'category' => 'nullable|string|max:255',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after:today',
        ]);

        Job::create([
            'company_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'type' => $validated['job_type'],
            'category' => $validated['category'] ?? null,
            'salary_min' => $validated['min_salary'] ?? null,
            'salary_max' => $validated['max_salary'] ?? null,
            'status' => 'pending',
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('jobs.index');
    }

    public function show(Job $job)
    {
        $job->load('company');
        
        return Inertia::render('Jobs/Show', [
            'job' => $job
        ]);
    }

    public function edit(Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('Jobs/Edit', [
            'job' => $job
        ]);
    }

    public function update(Request $request, Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,remote',
            'category' => 'nullable|string|max:255',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'type' => $validated['job_type'],
            'category' => $validated['category'] ?? null,
            'salary_min' => $validated['min_salary'] ?? null,
            'salary_max' => $validated['max_salary'] ?? null,
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('jobs.index');
    }

    public function destroy(Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('jobs.index');
    }
}