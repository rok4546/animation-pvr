<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Page;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        $featured_products = Product::where('is_featured', true)->where('is_active', true)->take(8)->get();
        $new_products = Product::where('is_active', true)->latest()->take(8)->get();
        $categories = Category::where('is_active', true)->take(10)->get();
        $animationPage = Page::where('slug', 'animation')->where('is_active', true)->first();
        
        return view('home', compact('banners', 'featured_products', 'new_products', 'categories', 'animationPage'));
    }

    public function page($slug, Request $request)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $animationPage = Page::where('slug', 'animation')->where('is_active', true)->first();
        $selectedDropdown = $request->query('dropdown'); // Get dropdown filter from URL
        return view('page', compact('page', 'animationPage', 'selectedDropdown'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->where('is_active', true)->first();
        if (!$page) {
            $page = (object) ['title' => 'About Us', 'content' => 'Welcome to our store'];
        }
        return view('about', compact('page'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // You can send email here or save to database
        // For now just show success message
        return back()->with('success', 'Thank you for your message. We will contact you soon!');
    }
}
