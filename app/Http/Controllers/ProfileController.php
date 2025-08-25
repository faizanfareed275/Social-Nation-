<?php

namespace App\Http\Controllers;

use App\Models\User;          
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class ProfileController extends Controller
{

    public function show(User $user)
{
    $posts = $user->posts()->latest()->get();
    return view('profile.show', compact('user', 'posts'));
}

    /**
     * Show the user's profile edit form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'username' => 'required|string|max:50|unique:users,username,' . $user->id,
        'bio' => 'nullable|string|max:1000',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'profile_photo' => 'nullable|image|max:2048',
        'cover_photo' => 'nullable|image|max:4096',
    ]);

    // Upload profile photo
    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
            \Storage::disk('public')->delete($user->profile_photo);
        }
        $validated['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
    }

    // Upload cover photo
    if ($request->hasFile('cover_photo')) {
        if ($user->cover_photo && \Storage::disk('public')->exists($user->cover_photo)) {
            \Storage::disk('public')->delete($user->cover_photo);
        }
        $validated['cover_photo'] = $request->file('cover_photo')->store('covers', 'public');
    }

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->fill($validated)->save();

    return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
}

public function removePhoto(Request $request, $type)
{
    $user = $request->user();

    if ($type === 'profile' && $user->profile_photo) {
        \Storage::disk('public')->delete($user->profile_photo);
        $user->profile_photo = null;
    }

    if ($type === 'cover' && $user->cover_photo) {
        \Storage::disk('public')->delete($user->cover_photo);
        $user->cover_photo = null;
    }

    $user->save();

    return back()->with('status', ucfirst($type).' photo removed successfully!');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
