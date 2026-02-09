<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.pages.create', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'has_dropdowns' => 'nullable|boolean',
            'dropdowns' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['has_dropdowns'] = $request->has('has_dropdowns');
        
        // Store dropdowns as JSON
        if ($request->has('dropdowns') && $validated['has_dropdowns']) {
            $dropdowns = $request->input('dropdowns', []);
            $validated['dropdowns'] = json_encode($dropdowns);
        } else {
            $validated['dropdowns'] = null;
        }

        Page::create($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        $products = Product::all();
        $categories = Category::all();
        $page_dropdowns = $page->dropdowns ? json_decode($page->dropdowns, true) : [];
        return view('admin.pages.edit', compact('page', 'products', 'categories', 'page_dropdowns'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'has_dropdowns' => 'nullable|boolean',
            'dropdowns' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['has_dropdowns'] = $request->has('has_dropdowns');
        
        // Store dropdowns as JSON
        if ($request->has('dropdowns') && $validated['has_dropdowns']) {
            $dropdowns = $request->input('dropdowns', []);
            $validated['dropdowns'] = json_encode($dropdowns);
        } else {
            $validated['dropdowns'] = null;
        }

        $page->update($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }
}
