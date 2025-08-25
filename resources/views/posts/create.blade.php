
@extends('layouts.social')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Create Post</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Post Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Caption</label>
            <textarea name="caption" rows="3" class="w-full border rounded px-3 py-2">{{ old('caption') }}</textarea>
            @error('caption') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Post</button>
    </form>
</div>
@endsection


    <!-- Floating Button -->
    <a href="{{ route('posts.create') }}" class="floating-button md:hidden"><i class="fas fa-plus text-2xl"></i></a>
</body>
</html>
