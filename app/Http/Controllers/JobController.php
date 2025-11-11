<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Tampilkan semua job yang dibuat oleh company login.
     */
    public function index()
    {
        // Gunakan pagination agar jobs punya struktur "data" dan "links"
        $jobs = Job::where('user_id', auth()->id())
            ->latest()
            ->paginate(5)
            ->through(fn ($job) => [
                'id' => $job->id,
                'title' => $job->title,
                'description' => $job->description,
                'location' => $job->location,
                'type' => $job->job_type,
                'salary_min' => $job->min_salary,
                'salary_max' => $job->max_salary,
                'status' => $job->status,
            ]);

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Form untuk menambahkan job baru.
     */
    public function create()
    {
        return Inertia::render('Jobs/Create');
    }

    /**
     * Simpan data job baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'min_salary' => 'required|numeric',
            'max_salary' => 'required|numeric',
        ]);

        Job::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'category' => $request->category,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'status' => 'pending', // default status job baru
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diposting!');
    }

    /**
     * Tampilkan detail job tertentu.
     */
    public function show(Job $job)
    {
        return Inertia::render('Jobs/Show', [
            'job' => $job,
        ]);
    }

    /**
     * Form untuk mengedit job.
     */
    public function edit(Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        return Inertia::render('Jobs/Edit', [
            'job' => $job,
        ]);
    }

    /**
     * Update data job yang sudah ada.
     */
    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'min_salary' => 'required|numeric',
            'max_salary' => 'required|numeric',
        ]);

        $job->update($request->only([
            'title', 'description', 'location', 'job_type',
            'category', 'min_salary', 'max_salary'
        ]));

        return redirect()->route('jobs.index')->with('success', 'Job berhasil diperbarui!');
    }

    /**
     * Hapus job dari database.
     */
    public function destroy(Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job berhasil dihapus!');
    }
}
