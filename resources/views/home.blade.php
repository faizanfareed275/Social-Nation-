@extends('layouts.app')

@section('content')
<section class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-200 via-white to-purple-200 px-4">
    <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-2xl p-8 sm:p-10 w-full max-w-md border border-white/30">
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 justify-center text-blue-700 text-3xl font-extrabold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                SocialNation
            </div>
            <p class="text-gray-700 text-base mt-1 font-medium">Where conversations become communities.</p>
        </div>

        @guest
        <div class="flex flex-col gap-3 mt-6">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white text-base font-semibold py-2.5 text-center rounded-md hover:bg-blue-700 transition">
                Create Account
            </a>
            <a href="{{ route('login') }}" class="text-blue-600 text-center text-sm font-medium hover:underline ">
                Already have an account? Login
            </a>
        </div>
        @else
        <div class="text-center">
            <h2 class="text-lg font-semibold text-gray-800">Welcome back,</h2>
            <p class="text-blue-700 font-bold text-xl">{{ Auth::user()->name }} 👋</p>
            <a href="{{ route('posts.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-md transition text-sm">
                Go to Dashboard
            </a>
        </div>
        @endguest

        <div class="mt-8 text-center text-xs text-gray-500">
            &copy; {{ now()->year }} SocialNation. All rights reserved.
        </div>
    </div>
</section>
@endsection
