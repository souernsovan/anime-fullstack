@extends('layouts.admin')

@section('title', 'Episodes')

@section('content')
<div class="w-full mt-10 p-5 rounded-lg">

    <!-- Header + Filter -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-indigo-600">Episodes</h1>

        <div class="flex gap-4 items-center">

            <!-- Filter Form -->
            <form method="GET" action="{{ route('episodes.index') }}" class="flex gap-2 items-center">
                <select name="anime_id" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Anime</option>
                    @foreach($animes as $anime)
                        <option value="{{ $anime->id }}" {{ ($filterAnimeId ?? '') == $anime->id ? 'selected' : '' }}>
                            {{ $anime->title }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                    Filter
                </button>
            </form>

            <!-- Add Episode Button -->
            <a href="{{ route('episodes.create') }}" 
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">
               + Add Episode
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Episodes Table -->
    <div class="">
        <table class="w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Thumbnail</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Anime</th>
                    <th class="px-4 py-3">Episode #</th>
                    <th class="px-4 py-3">Video</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($episodes as $index => $ep)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>

                    <!-- Thumbnail -->
                    <td class="px-4 py-3 w-32">
                        @if($ep->thumbnail)
                            <img src="{{ $ep->thumbnail }}" alt="{{ $ep->title }}" class="w-24 h-16 object-cover rounded">
                        @else
                            <div class="w-24 h-16 bg-gray-200 flex items-center justify-center text-gray-500 text-xs rounded">
                                No Image
                            </div>
                        @endif
                    </td>

                    <!-- Title -->
                    <td class="px-4 py-3 font-semibold">{{ $ep->title }}</td>

                    <!-- Anime -->
                    <td class="px-4 py-3 text-gray-600">{{ $ep->anime->title }}</td>

                    <!-- Episode Number -->
                    <td class="px-4 py-3 text-gray-600">{{ $ep->episode_number }}</td>

                    <!-- Video -->
                    <td class="px-4 py-3">
                        <a href="{{ $ep->video_url }}" target="_blank" 
                           class="text-indigo-600 hover:text-indigo-800 font-medium">▶ Watch</a>
                    </td>

                    <!-- Actions -->
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('episodes.edit', $ep->id) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow text-sm">
                           Edit
                        </a>
                        <form action="{{ route('episodes.destroy', $ep->id) }}" method="POST" 
                              onsubmit="return confirm('Delete this episode?');">
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
                <!-- Empty row with message -->
                <tr class="border-t">
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        No episodes available for the selected filter.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection