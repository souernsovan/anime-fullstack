@extends('layouts.admin')

@section('title', 'Anime List')

@section('content')
<div class="w-full mt-10 p-5 rounded-lg">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-indigo-600">Anime List</h1>
        <a href="{{ route('animes.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">
           + Add New Anime
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Anime Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Poster</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Studio</th>
                    <th class="px-4 py-3">Year</th>
                    <th class="px-4 py-3">Rating</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($animes as $index => $anime)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">
                        @if($anime->poster)
                            <img src="{{ asset('storage/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-16 h-24 object-cover rounded shadow">
                        @else
                            <div class="w-16 h-24 bg-gray-200 flex items-center justify-center text-gray-400 text-sm rounded">No Image</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-semibold">{{ $anime->title }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $anime->description ?: 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $anime->studio ?: 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $anime->release_year ?: 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $anime->rating ? $anime->rating . '/10' : 'N/A' }}</td>

                    <!-- Actions -->
                    <td class="px-4 py-3 flex gap-2">
                        <!-- Edit -->
                        <a href="{{ route('animes.edit', $anime->id) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow text-sm">
                           Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('animes.destroy', $anime->id) }}" method="POST" 
                              onsubmit="return confirm('Delete this anime?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        No anime available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection