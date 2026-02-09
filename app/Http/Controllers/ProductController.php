<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);
        
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        
        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        
        $product->load('reviews', 'category');
        $reviews = $product->reviews()->where('is_approved', true)->latest()->paginate(5);
        $related_products = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->where('is_active', true)
                                    ->take(4)
                                    ->get();
        
        return view('products.show', compact('product', 'reviews', 'related_products'));
    }

    public function addReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|min:5',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
        ]);

        $validated['product_id'] = $product->id;
        
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Review::create($validated);
        return back()->with('success', 'Your review has been submitted and will be approved soon!');
    }
}
