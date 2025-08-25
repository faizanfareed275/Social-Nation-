@extends('layouts.social')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Social Feed</h1>
        <p class="text-gray-600">Latest posts from your community</p>
    </div>

    @foreach ($posts as $post)
        <div class="post-container bg-white rounded-xl shadow-post mb-8 overflow-hidden">
            <div class="relative">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-80 object-cover">

                <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-sm rounded-full px-3 py-1.5 flex items-center">
                    <div class="avatar rounded-full flex items-center justify-center text-white font-bold mr-2">
                        {{ strtoupper(substr($post->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-primary">{{ $post->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($post->caption)
                    <p class="text-gray-800 text-base mb-4">{{ $post->caption }}</p>
                @endif

                <div class="flex items-center justify-between border-t border-b border-gray-100 py-3 my-3">
                   <form method="POST" action="{{ route('posts.like', $post) }}">
    @csrf
    <button 
        type="submit" 
        class="like-btn flex items-center px-3 py-1 rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:border-red-200 transition-all"
    >
        @if ($post->isLikedBy(auth()->user()))
            <i class="fas fa-heart text-red-500 mr-1"></i>
        @else
            <i class="far fa-heart mr-1"></i>
        @endif
        <span class="ml-1 text-sm">{{ $post->likes()->count() }}</span>
    </button>
</form>


                    <div class="flex items-center text-gray-500">
                        <i class="far fa-comment mr-2"></i>
                        <span>{{ $post->comments->count() }} comments</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('posts.comments.store', $post) }}" class="mb-4">
                    @csrf
                    <div class="flex items-center">
                        <div class="avatar rounded-full flex items-center justify-center text-white font-bold mr-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <input
                            type="text"
                            name="body"
                            placeholder="Write a comment..."
                            class="comment-input flex-1 border border-gray-200 rounded-full px-4 py-2.5 text-sm focus:outline-none focus:border-primary"
                            required
                        >
                    </div>
                </form>

                <div class="space-y-4">
    @foreach ($post->comments as $comment)
        <div class="flex">
       <div class="avatar rounded-full flex items-center justify-center text-white font-bold mr-3 bg-gradient-to-br from-blue-500 to-purple-500 w-10 h-10">
    {{ strtoupper(substr($comment->user->name, 0, 2)) }}
</div>

            <div class="flex-1">
                <div class="comment-bubble px-4 py-2.5">
                    <p class="text-sm">
                        <span class="font-semibold text-gray-800 !text-gray-800">{{ $comment->user->name }}</span> {{ $comment->body }}
                    </p>
                </div>
                <p class="text-xs text-gray-500 mt-1 ml-2">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @endforeach
</div>


            </div>
        </div>
    @endforeach
</div>
@endsection
