@extends('layouts.admin')

@section('title', 'Add Episode')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-indigo-600">{{ isset($episode) ? 'Edit Episode' : 'Add Episode' }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-6 rounded shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($episode) ? route('episodes.update', $episode->id) : route('episodes.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @if(isset($episode))
            @method('PUT')
        @endif

        <!-- Anime Select -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Anime</label>
            <select name="anime_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach($animes as $anime)
                    <option value="{{ $anime->id }}" {{ (old('anime_id', $episode->anime_id ?? '') == $anime->id) ? 'selected' : '' }}>
                        {{ $anime->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Title -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Episode Title</label>
            <input type="text" name="title" value="{{ old('title', $episode->title ?? '') }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Episode Number -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Episode Number</label>
            <input type="number" name="episode_number" value="{{ old('episode_number', $episode->episode_number ?? '') }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Video URL -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Video URL</label>
            <input type="url" name="video_url" value="{{ old('video_url', $episode->video_url ?? '') }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Thumbnail -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Thumbnail URL</label>
            <input type="url" name="thumbnail" value="{{ old('thumbnail', $episode->thumbnail ?? '') }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded shadow">
                {{ isset($episode) ? 'Update Episode' : 'Add Episode' }}
            </button>
            <a href="{{ route('episodes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded shadow">Cancel</a>
        </div>
    </form>
</div>
@endsection