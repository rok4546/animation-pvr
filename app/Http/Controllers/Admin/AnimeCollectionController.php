<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnimeCollectionController extends Controller
{
    public function index()
    {
        $collections = AnimeCollection::withCount('products')->orderBy('sort_order')->get();
        return view('admin.anime-collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.anime-collections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('anime-collections', 'public');
        }

        AnimeCollection::create($validated);

        return redirect()->route('admin.anime-collections.index')
            ->with('success', 'Anime collection created successfully!');
    }

    public function edit(AnimeCollection $animeCollection)
    {
        return view('admin.anime-collections.edit', compact('animeCollection'));
    }

    public function update(Request $request, AnimeCollection $animeCollection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($animeCollection->image) {
                Storage::disk('public')->delete($animeCollection->image);
            }
            $validated['image'] = $request->file('image')->store('anime-collections', 'public');
        }

        $animeCollection->update($validated);

        return redirect()->route('admin.anime-collections.index')
            ->with('success', 'Anime collection updated successfully!');
    }

    public function destroy(AnimeCollection $animeCollection)
    {
        if ($animeCollection->image) {
            Storage::disk('public')->delete($animeCollection->image);
        }

        $animeCollection->delete();

        return redirect()->route('admin.anime-collections.index')
            ->with('success', 'Anime collection deleted successfully!');
    }
}
