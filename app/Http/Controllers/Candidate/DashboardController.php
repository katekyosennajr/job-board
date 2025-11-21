<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isCompany()) {
            // Get company's jobs with application counts
            $jobs = Job::where('user_id', $user->id)
                ->withCount('applications')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function($job) {
                    return [
                        'id' => $job->id,
                        'title' => $job->title,
                        'status' => $job->status,
                        'applications' => $job->applications_count,
                        'posted' => $job->created_at->diffForHumans(),
                    ];
                });
            
            $totalApplications = JobApplication::whereIn('job_id', Job::where('user_id', $user->id)->pluck('id'))->count();
            
            return inertia('Dashboard', [
                'auth' => [
                    'user' => $user,
                ],
                'myJobs' => $jobs,
                'stats' => [
                    'totalJobs' => $jobs->count(),
                    'totalApplications' => $totalApplications,
                ],
            ]);
        } elseif ($user->isCandidate()) {
            $jobs = Job::where('status', 'approved')->latest()->take(10)->get();
            
            // Get candidate stats
            $applicationsSent = JobApplication::where('candidate_id', $user->id)->count();
            // TODO: Implement saved jobs feature
            $savedJobs = 0;
            // TODO: Implement profile views tracking
            $profileViews = 0;
            
            return inertia('Dashboard', [
                'auth' => [
                    'user' => $user,
                ],
                'jobs' => $jobs,
                'stats' => [
                    'applicationsSent' => $applicationsSent,
                    'savedJobs' => $savedJobs,
                    'profileViews' => $profileViews,
                ],
            ]);
        } else {
            // Admin
            return inertia('Dashboard', [
                'auth' => [
                    'user' => $user,
                ],
            ]);
        }
    }

    public function cvBuilder()
    {
        return inertia('Candidate/CVBuilder');
    }
}
