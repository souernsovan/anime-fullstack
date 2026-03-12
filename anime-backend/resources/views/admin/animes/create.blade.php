@extends('layouts.admin')

@section('title', 'Create Anime')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Anime</h1>

<form action="{{ route('animes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block mb-1">Title</label>
        <input type="text" name="title" class="border p-2 w-full" required>
    </div>
    <!-- add description -->

    <div>
        <label class="block mb-1">Description</label>
        <input type="text" name="description" class="border p-2 w-full" required>
    </div>

    <div>
        <label class="block mb-1">Studio</label>
        <input type="text" name="studio" class="border p-2 w-full">
    </div>

    <div>
        <label class="block mb-1">Release Year</label>
        <input type="number" name="release_year" class="border p-2 w-full">
    </div>

    <div>
        <label class="block mb-1">Rating</label>
        <input type="number" step="0.1" min="0" max="10" name="rating" class="border p-2 w-full">
    </div>

    <div>
        <label class="block mb-1">Poster</label>
        <input type="file" name="poster" class="border p-2 w-full">
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Create</button>
    <a href="{{ route('animes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Back</a>
</form>
@endsection