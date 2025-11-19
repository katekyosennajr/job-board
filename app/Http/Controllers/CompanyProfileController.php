<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CompanyProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

        return Inertia::render('Company/Profile', [
            'user' => $user,
            'company' => $companyProfile,
            'status' => session('status'),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'website' => ['nullable', 'url'],
            'industry' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'password' => ['nullable', 'string', 'min:8'],
            'password_confirmation' => ['nullable', 'string', 'same:password'],
        ]);

        // Update user
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $companyProfile = CompanyProfile::where('user_id', $user->id)->first();
            if ($companyProfile && $companyProfile->logo && Storage::exists($companyProfile->logo)) {
                Storage::delete($companyProfile->logo);
            }
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo'] = $path;
        }

        // Update or create company profile
        CompanyProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'company_name' => $validated['company_name'],
                'website' => $validated['website'] ?? null,
                'industry' => $validated['industry'] ?? null,
                'location' => $validated['location'] ?? null,
                'description' => $validated['description'] ?? null,
                'logo' => $validated['logo'] ?? null,
            ]
        );

        return back()->with('status', 'profile-updated');
    }
}
