<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    // ---------------- API ----------------
    public function index()
    {
        $animes = Anime::with('episodes')->get()->map(function ($anime) {
            $anime->poster = $anime->poster ? asset('storage/' . $anime->poster) : null;
            return $anime;
        });

        return response()->json($animes);
    }

    public function show($id)
    {
        $anime = Anime::with('episodes')->findOrFail($id);
        $anime->poster = $anime->poster ? asset('storage/' . $anime->poster) : null;
        return response()->json($anime);
    }

    // ---------------- Blade ----------------
    public function webIndex()
    {
        $animes = Anime::with('episodes')->get();
        return view('admin.animes.index', compact('animes'));
    }

    public function create()
    {
        return view('admin.animes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:animes,title',
            'description' => 'nullable|string',
            'studio' => 'nullable|string|max:255',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:5120',
        ]);

        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $anime = Anime::create($data);

        if ($request->wantsJson()) {
            $anime->poster = $anime->poster ? asset('storage/' . $anime->poster) : null;
            return response()->json($anime, 201);
        }

        return redirect()->route('animes.index')->with('success', 'Anime created successfully!');
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        return view('admin.animes.edit', compact('anime'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required','string','max:255', Rule::unique('animes')->ignore($anime->id)],
            'description' => 'nullable|string',
            'studio' => 'nullable|string|max:255',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:5120',
        ]);

        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            if ($anime->poster) {
                Storage::disk('public')->delete($anime->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $anime->update($validated);

        if ($request->wantsJson()) {
            $anime->poster = $anime->poster ? asset('storage/' . $anime->poster) : null;
            return response()->json($anime);
        }

        return redirect()->route('animes.index')->with('success', 'Anime updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        if ($anime->poster) {
            Storage::disk('public')->delete($anime->poster);
        }

        $anime->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Anime deleted successfully', 'status' => 'Success']);
        }

        return redirect()->route('animes.index')->with('success', 'Anime deleted successfully!');
    }
}