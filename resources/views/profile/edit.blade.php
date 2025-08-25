@extends('layouts.social')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PATCH')

        <!-- Username -->
        <div class="mb-4">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label class="block text-gray-700">Bio</label>
            <textarea name="bio" rows="3" class="w-full border-gray-300 rounded px-3 py-2 mt-1">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded px-3 py-2 mt-1" required>
        </div>

        <!-- Profile Photo -->
        <div class="mb-4">
            <label class="block text-gray-700">Profile Photo</label>
            @if ($user->profile_photo)
                <div class="flex items-center mb-2">
                    <img src="{{ asset('storage/'.$user->profile_photo) }}" class="w-16 h-16 rounded-full object-cover mr-3">
                    <form action="{{ route('profile.photo.remove', 'profile') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-sm">Remove</button>
                    </form>
                </div>
            @endif
            <input type="file" name="profile_photo" class="w-full border-gray-300 rounded px-3 py-2 mt-1">
        </div>

        <!-- Cover Photo -->
        <div class="mb-4">
            <label class="block text-gray-700">Cover Photo</label>
            @if ($user->cover_photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$user->cover_photo) }}" class="w-full h-40 object-cover rounded">
                    <form action="{{ route('profile.photo.remove', 'cover') }}" method="POST" class="mt-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-sm">Remove</button>
                    </form>
                </div>
            @endif
            <input type="file" name="cover_photo" class="w-full border-gray-300 rounded px-3 py-2 mt-1">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Profile</button>
    </form>
@endsection
