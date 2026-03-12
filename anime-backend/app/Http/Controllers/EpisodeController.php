<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Anime;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    // ---------------- API ----------------

    // Get all episodes
    public function index()
    {
        return Episode::with('anime')->get();
    }

    // Get a single episode
    public function show($id)
    {
        return Episode::with('anime')->findOrFail($id);
    }

    // Store a new episode (Blade & API)
public function store(Request $request)
{
    $validated = $request->validate([
        'anime_id' => 'required|exists:animes,id',
        'title' => 'required|string|max:255',
        'episode_number' => 'required|integer|min:1',
        'video_url' => 'required|url',
        'thumbnail' => 'nullable|url',
    ]);

    $episode = Episode::create($validated);

    if ($request->wantsJson()) {
        return response()->json($episode, 201);
    }

    // Redirect to episodes list page with success message
    return redirect()->route('episodes.index')->with('success', 'Episode added successfully!');
    }

    // Update an episode (Blade & API)
    public function update(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);

        $validated = $request->validate([
            'anime_id' => 'required|exists:animes,id',
            'title' => 'required|string|max:255',
            'episode_number' => 'required|integer|min:1',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|url',
        ]);

        $episode->update($validated);

        if ($request->wantsJson()) {
            return response()->json($episode);
        }

        // Redirect to episodes list page with success message
        return redirect()->route('episodes.index')->with('success', 'Episode updated successfully!');
    }

    // Edit episode form (Blade)
    public function edit($id)
    {
        $episode = Episode::findOrFail($id);
        $animes = Anime::all();
        return view('admin.episodes.edit', compact('episode', 'animes'));
    }



    // Delete episode (API or Blade)
    public function destroy(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Episode deleted successfully']);
        }

        return redirect()->back()->with('success', 'Episode deleted successfully!');
    }

    // Blade: Create form
    public function create()
    {
        $animes = Anime::all();
        return view('admin.episodes.create', compact('animes'));
    }

    // Blade: List all episodes
    public function webIndex(Request $request)
    {
        // Get all anime for filter dropdown
        $animes = Anime::all();

        // Get selected anime ID from request
        $filterAnimeId = $request->query('anime_id');

        // Query episodes
        $episodes = Episode::with('anime')
            ->when($filterAnimeId, function ($query, $filterAnimeId) {
                $query->where('anime_id', $filterAnimeId);
            })
            ->get();

        return view('admin.episodes.index', compact('episodes', 'animes', 'filterAnimeId'));
    }
}