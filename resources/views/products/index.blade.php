@extends('layouts.app')

@section('title', 'Products - ANIME ARTISTRY')

@section('content')
<div class="container">
    <h1 style="
        margin: 60px 0 40px;
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: slideInLeft 0.8s ease;
        letter-spacing: 1px;
    ">🛍️ Products</h1>
    
    <div style="display: grid; grid-template-columns: 220px 1fr; gap: 40px;">
        <!-- Sidebar Filters -->
        <div style="animation: slideInLeft 0.8s ease;">
            <!-- Category Filter -->
            <div style="
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.1);
                margin-bottom: 25px;
                border: 1px solid rgba(102, 126, 234, 0.1);
            ">
                <h3 style="
                    margin-bottom: 18px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #1a1a1a;
                    border-bottom: 2px solid #667eea;
                    padding-bottom: 12px;
                ">🏷️ Filter by Category</h3>
                <form method="GET" id="filterForm">
                    <div style="margin-bottom: 12px;">
                        <label style="
                            display: flex;
                            align-items: center;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            padding: 8px;
                            border-radius: 6px;
                        "
                        onmouseover="this.style.background='rgba(102, 126, 234, 0.1)'"
                        onmouseout="this.style.background='transparent'">
                            <input type="radio" name="category" value="" @checked(!request('category')) onchange="document.getElementById('filterForm').submit()" style="cursor: pointer;"> 
                            <span style="margin-left: 10px; color: #666; font-weight: 500;">All Categories</span>
                        </label>
                    </div>
                    @foreach ($categories as $category)
                        <div style="margin-bottom: 12px;">
                            <label style="
                                display: flex;
                                align-items: center;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                padding: 8px;
                                border-radius: 6px;
                            "
                            onmouseover="this.style.background='rgba(102, 126, 234, 0.1)'"
                            onmouseout="this.style.background='transparent'">
                                <input type="radio" name="category" value="{{ $category->id }}" @checked(request('category') == $category->id) onchange="document.getElementById('filterForm').submit()" style="cursor: pointer;"> 
                                <span style="margin-left: 10px; color: #666; font-weight: 500;">{{ $category->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </form>
            </div>

            <!-- Sort Filter -->
            <div style="
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.1);
                border: 1px solid rgba(102, 126, 234, 0.1);
            ">
                <h3 style="
                    margin-bottom: 18px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #1a1a1a;
                    border-bottom: 2px solid #667eea;
                    padding-bottom: 12px;
                ">📊 Sort By</h3>
                <form method="GET">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()" style="
                        width: 100%;
                        padding: 12px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        background: white;
                        cursor: pointer;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                        <option value="">Newest</option>
                        <option value="price_low" @selected(request('sort') == 'price_low')>Price: Low to High</option>
                        <option value="price_high" @selected(request('sort') == 'price_high')>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div style="animation: slideInRight 0.8s ease;">
            <!-- Search Bar -->
            <form method="GET" style="margin-bottom: 40px; animation: fadeIn 0.8s ease;">
                <div style="display: flex; gap: 12px;">
                    <input type="text" name="search" placeholder="🔍 Search products..." value="{{ request('search') }}" style="
                        flex: 1;
                        padding: 14px 18px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 15px;
                        transition: all 0.3s ease;
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                    <button type="submit" class="btn" style="padding: 14px 28px; font-weight: 700;">Search</button>
                </div>
            </form>

            @if ($products->count())
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <div style="width: 100%; height: 100%; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: #999;">No Image</span>
                                    </div>
                                @endif
                                @if ($product->compare_price && $product->compare_price > $product->price)
                                    <div class="product-badge">SALE</div>
                                @endif
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                
                                <div class="product-price">
                                    @if ($product->compare_price && $product->compare_price > $product->price)
                                        <span class="original">₹{{ number_format($product->compare_price, 0) }}</span>
                                    @endif
                                    <span class="current">₹{{ number_format($product->price, 0) }}</span>
                                </div>
                                
                                <div class="product-actions">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn" style="width: 100%; text-align: center;">View</a>
                                    <form method="POST" action="{{ route('cart.add', $product) }}" style="width: 100%;">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn" style="width: 100%;">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 40px; text-align: center;">
                    {{ $products->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 8px;">
                    <h2 style="color: #999; margin-bottom: 15px;">No Products Found</h2>
                    <p style="color: #999;">Try adjusting your search or filter criteria</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
