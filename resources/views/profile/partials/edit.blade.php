@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md mt-10">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Your Profile</h2>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            Profile updated successfully.
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Username -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('username') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Bio -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="3"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Profile Photo -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Profile Photo</label>
            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-20 h-20 rounded-full object-cover mb-2">
            @endif
            <input type="file" name="profile_photo"
                class="block w-full text-sm text-gray-600 border rounded-lg file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
            @error('profile_photo') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Cover Photo -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Cover Photo</label>
            @if ($user->cover_photo)
                <img src="{{ asset('storage/' . $user->cover_photo) }}" class="w-full h-32 object-cover rounded-md mb-2">
            @endif
            <input type="file" name="cover_photo"
                class="block w-full text-sm text-gray-600 border rounded-lg file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200">
            @error('cover_photo') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
