@extends('layouts.admin')

@section('title', 'Edit Anime')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <!-- Breadcrumb -->
    <nav class="text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
        <ol class="list-reset flex">
            <li>
                <a href="{{ route('animes.index') }}" class="hover:underline">Anime List</a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-700">Edit: {{ $anime->title }}</li>
        </ol>
    </nav>

    <h1 class="text-3xl font-bold mb-6 text-indigo-600">Edit Anime: {{ $anime->title }}</h1>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-6 rounded shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('animes.update', $anime->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Title -->
            <div>
                <label class="block font-semibold mb-1" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $anime->title) }}" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Studio -->
            <div>
                <label class="block font-semibold mb-1" for="studio">Studio</label>
                <input type="text" name="studio" id="studio" value="{{ old('studio', $anime->studio) }}" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Release Year -->
            <div>
                <label class="block font-semibold mb-1" for="release_year">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year', $anime->release_year) }}" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Rating -->
            <div>
                <label class="block font-semibold mb-1" for="rating">Rating (0-10)</label>
                <input type="number" step="0.1" name="rating" id="rating" value="{{ old('rating', $anime->rating) }}" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Poster -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-2" for="poster">Poster</label>
                <div class="flex items-center gap-4 mb-2">
                    @if($anime->poster)
                        <img id="poster-preview" src="{{ asset('storage/' . $anime->poster) }}" 
                             alt="{{ $anime->title }}" class="w-32 h-32 object-cover rounded shadow">
                    @else
                        <div id="poster-preview" class="w-32 h-32 bg-gray-200 flex items-center justify-center text-gray-400 rounded shadow">
                            No Image
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="poster" id="poster" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <p class="text-gray-500 text-sm mt-1">Upload new poster to replace existing. Allowed: jpg, jpeg, png, gif, webp, svg.</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1" for="description">Description</label>
                <textarea name="description" id="description" rows="5" 
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $anime->description) }}</textarea>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex gap-3">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded shadow">
                Update Anime
            </button>
            <a href="{{ route('animes.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded shadow flex items-center">
               Cancel
            </a>
        </div>
    </form>
</div>

<!-- JS for Poster Preview -->
<script>
    const posterInput = document.getElementById('poster');
    const posterPreview = document.getElementById('poster-preview');

    posterInput.addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            posterPreview.src = URL.createObjectURL(file);
        }
    });
</script>
@endsection