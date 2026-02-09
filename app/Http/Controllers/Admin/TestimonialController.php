<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('product')->orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        $products = \App\Models\Product::orderBy('name')->get();
        return view('admin.testimonials.edit', compact('testimonial', 'products'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => !$testimonial->is_approved]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial approval status updated!');
    }

    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial featured status updated!');
    }
}
