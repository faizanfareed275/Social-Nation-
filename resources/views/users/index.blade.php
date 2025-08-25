@extends('layouts.social')

@section('content')
<div class="bg-white p-4 rounded shadow mb-6">
    <form method="GET" action="{{ route('users.index') }}">
        <input type="text" name="search" placeholder="Search users..."
            value="{{ request('search') }}"
            class="border rounded px-3 py-1 w-full">
    </form>
</div>

@foreach ($users as $user)
    <div class="bg-white p-4 rounded shadow mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
            <p class="text-sm text-gray-500">Followers: {{ $user->followers()->count() }}</p>
        </div>

        <div>
            <a href="{{ route('users.profile', $user) }}"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">View Profile</a>
        </div>
    </div>
@endforeach

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
