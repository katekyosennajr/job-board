<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function talentSearch()
    {
        // Get all candidates (users with role 'candidate')
        $candidates = User::where('role', 'candidate')
            ->select('id', 'name', 'email', 'created_at')
            ->latest()
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'location' => null, // TODO: Add location from candidate_profiles table
                    'created_at' => $user->created_at,
                ];
            });

        return Inertia::render('Company/TalentSearch', [
            'candidates' => $candidates
        ]);
    }
}
