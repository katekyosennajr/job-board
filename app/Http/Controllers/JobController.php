<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('user_id', auth()->id())->latest()->get();

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

        Job::create([
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

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diposting!');
    }

    public function edit(Job $job)
    {
        return Inertia::render('Jobs/Edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
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

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diperbarui!');
    }

    public function destroy(Job $job)
    {
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
}
