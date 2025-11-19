<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CandidateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(),
            'status' => session('status'),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo_path && Storage::exists($user->profile_photo_path)) {
                Storage::delete($user->profile_photo_path);
            }
            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo_path'] = $path;
        }

        // Handle password update
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['password_confirmation']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update candidate profile if user is candidate
        if ($user->role === 'candidate') {
            CandidateProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $validated['name'] ?? $user->name,
                    'phone' => $validated['phone'] ?? null,
                    'location' => $validated['location'] ?? null,
                    'bio' => $validated['bio'] ?? null,
                    'skills' => $validated['skills'] ?? null,
                ]
            );
        }

        return back()->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile photo if exists
        if ($user->profile_photo_path && Storage::exists($user->profile_photo_path)) {
            Storage::delete($user->profile_photo_path);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
