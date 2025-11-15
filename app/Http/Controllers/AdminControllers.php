<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;

class AdminController extends Controller
{
    public function jobs()
    {
        $jobs = Job::where('status', 'pending')->get();
        return inertia('Admin/Jobs', [
            'jobs' => $jobs
        ]);
    }

    public function users()
    {
        $users = User::all();
        return inertia('Admin/Users', [
            'users' => $users
        ]);
    }
}
