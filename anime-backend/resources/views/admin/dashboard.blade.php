@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold">Total Anime</h2>
        <p class="text-2xl mt-2">{{ \App\Models\Anime::count() }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold">Total Episodes</h2>
        <p class="text-2xl mt-2">{{ \App\Models\Episode::count() }}</p>
    </div>

</div>

@endsection