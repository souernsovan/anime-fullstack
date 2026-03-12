<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.1/lottie.min.js"></script>
</head>
<body class="flex h-screen bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
        <div class="p-6 text-2xl font-bold text-indigo-400">
            Anime Admin
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/dashboard') ? 'bg-gray-800' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('animes.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/animes*') ? 'bg-gray-800' : '' }}">
                Anime
            </a>
            <a href="{{ route('episodes.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/episodes*') ? 'bg-gray-800' : '' }}">
                Episode
            </a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 overflow-auto p-6">
        @yield('content')
    </main>

</body>
</html>