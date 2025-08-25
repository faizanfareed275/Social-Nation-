<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNation | Connect & Share</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#f3f4f6',
                        dark: '#1e293b',
                        accent: '#f59e0b'
                    },
                    boxShadow: {
                        'card': '0 4px 20px rgba(0, 0, 0, 0.08)',
                        'navbar': '0 4px 12px rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    </script>
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-navbar px-6 py-3 flex justify-between items-center sticky top-0 z-40">
        <div class="flex items-center">
            <div class="text-2xl font-bold text-primary flex items-center">
                <i class="fas fa-globe-americas mr-2"></i>
                <span>SocialNation</span>
            </div>
        </div>

        <!-- Desktop Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.index') ? 'active-nav' : '' }}"><i class="fas fa-home mr-2"></i>Home</a>
            <a href="{{ route('posts.create') }}" class="nav-link {{ request()->routeIs('posts.create') ? 'active-nav' : '' }}"><i class="fas fa-plus-circle mr-2"></i>Create</a>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active-nav' : '' }}"><i class="fas fa-search mr-2"></i>Explore</a>
            <a href="{{ route('users.profile', auth()->user()) }}" class="nav-link {{ request()->routeIs('users.profile') ? 'active-nav' : '' }}"><i class="fas fa-user mr-2"></i>Profile</a>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="text-gray-500 hover:text-primary">
                    <i class="far fa-bell text-xl"></i>
                    <span class="notification-badge">3</span>
                </button>
            </div>
            <div class="relative group">
                <button class="flex items-center">
                    @if (auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover mr-2">
                    @else
                        <div class="avatar mr-2">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    @endif
                    <span class="text-gray-700 font-medium hidden md:inline">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down ml-1 text-gray-400 text-xs"></i>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                    <a href="{{ route('users.profile', auth()->user()) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-user-circle mr-2"></i>My Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-cog mr-2"></i>Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Nav -->
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg flex justify-around items-center py-3 md:hidden z-50">
        <a href="{{ route('posts.index') }}" class="flex flex-col items-center text-gray-700"><i class="fas fa-home text-lg"></i><span class="text-xs mt-1">Home</span></a>
        <a href="{{ route('posts.create') }}" class="flex flex-col items-center text-gray-700"><i class="fas fa-plus-circle text-lg"></i><span class="text-xs mt-1">Create</span></a>
        <a href="{{ route('users.index') }}" class="flex flex-col items-center text-gray-700"><i class="fas fa-search text-lg"></i><span class="text-xs mt-1">Explore</span></a>
        <a href="{{ route('users.profile', auth()->user()) }}" class="flex flex-col items-center text-gray-700"><i class="fas fa-user text-lg"></i><span class="text-xs mt-1">Profile</span></a>
    </div>

    <!-- Page Content -->
    <div class="flex max-w-7xl mx-auto mt-6 px-4 pb-20 md:pb-6">
        <!-- Left Sidebar -->
        <aside class="w-1/4 hidden lg:block pr-4">
            <div class="bg-white p-5 rounded-xl shadow-card">
                <div class="flex items-center mb-6">
                    @if (auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover mr-3">
                    @else
                        <div class="avatar mr-3">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    @endif
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ auth()->user()->name }}</h4>
                    </div>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('users.profile', auth()->user()) }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50"><i class="fas fa-user-circle text-primary mr-3"></i>My Profile</a>
                    <a href="{{ route('posts.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50"><i class="fas fa-newspaper text-blue-500 mr-3"></i>News Feed</a>
                    <a href="{{ route('posts.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50"><i class="fas fa-plus-circle text-green-500 mr-3"></i>Create Post</a>
                    <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50"><i class="fas fa-search text-purple-500 mr-3"></i>Explore Users</a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50"><i class="fas fa-cog text-gray-500 mr-3"></i>Settings</a>
                </div>
            </div>
        </aside>

        <!-- Main Feed -->
        <main class="w-full lg:w-1/2 px-2">
            @yield('content')
        </main>

        <!-- Right Sidebar -->
        <aside class="w-1/4 hidden lg:block pl-4">
            <div class="bg-white p-5 rounded-xl shadow-card">
                <h3 class="text-lg font-semibold mb-4">Suggestions</h3>
                @foreach ($suggestedUsers as $user)
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            @if ($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover mr-3">
                            @else
                                <div class="suggestion-avatar mr-3">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->mutual_friends }} mutual friends</p>
                            </div>
                        </div>
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            @if (auth()->user()->following->contains($user->id))
                                <button class="text-xs bg-gray-300 text-black px-3 py-1 rounded-full hover:bg-gray-400">Unfollow</button>
                            @else
                                <button class="text-xs bg-blue-600 text-white px-3 py-1 rounded-full hover:bg-blue-700">Follow</button>
                            @endif
                        </form>
                    </div>
                @endforeach
                <a href="#" class="block mt-4 text-center text-primary text-sm font-medium hover:underline">View all suggestions</a>
            </div>
        </aside>
    </div>

    <!-- Floating Button -->
    <a href="{{ route('posts.create') }}" class="floating-button md:hidden"><i class="fas fa-plus text-2xl"></i></a>
</body>
</html>
