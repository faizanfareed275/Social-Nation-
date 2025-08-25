@extends('layouts.social')

@section('content')
    <!-- Profile Cover and Photo -->
    <div class="relative mb-16">
        @if($user->cover_photo)
            <img src="{{ asset('storage/' . $user->cover_photo) }}" class="w-full h-60 object-cover rounded-lg shadow">
        @else
            <div class="w-full h-60 bg-gray-300 rounded-lg shadow"></div>
        @endif

        <div class="absolute -bottom-16 left-6 flex items-center">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-400 border-4 border-white shadow-lg flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 1, 1)) }}
                </div>
            @endif

            <div class="ml-6 mt-10">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                @if($user->bio)
                    <p class="text-gray-600">{{ $user->bio }}</p>
                @endif
                <div class="flex items-center space-x-4 mt-2 text-gray-500 text-sm">
                    <span><strong>{{ $user->posts->count() }}</strong> Posts</span>
                    <span><strong>{{ $user->followers()->count() }}</strong> Followers</span>
                    <span><strong>{{ $user->following()->count() }}</strong> Following</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end mb-6">
        @if (auth()->id() === $user->id)
            <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">Edit Profile</a>
        @else
            <form action="{{ route('users.follow', $user) }}" method="POST">
                @csrf
                @if(auth()->user()->following->contains($user->id))
                    <button class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400 shadow">Unfollow</button>
                @else
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">Follow</button>
                @endif
            </form>
        @endif
    </div>

    <!-- User's Posts -->
    <h3 class="text-xl font-semibold mb-4 text-gray-700">Posts</h3>
    @if ($user->posts->count() > 0)
        @foreach ($user->posts as $post)
            <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-72 object-cover">
                @endif
                <div class="p-4">
                    <p class="text-gray-700 mb-2">{{ $post->caption }}</p>
                    <div class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">This user has not posted anything yet.</p>
    @endif
@endsection
