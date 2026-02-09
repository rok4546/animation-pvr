@extends('layouts.app')

@section('title', $product->name . ' - ANIME ARTISTRY')
@section('meta_description', $product->meta_description ?? substr(strip_tags($product->description), 0, 160))
@section('meta_keywords', $product->meta_keywords)

@section('content')
<div class="container">
    <!-- Breadcrumb Navigation -->
    <div style="
        margin: 40px 0 30px;
        font-size: 14px;
        animation: slideInLeft 0.6s ease;
    ">
        <a href="{{ route('home') }}" style="
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        " onmouseover="this.style.color='#764ba2'" onmouseout="this.style.color='#667eea'">Home</a> > 
        <a href="{{ route('products.index') }}" style="
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        " onmouseover="this.style.color='#764ba2'" onmouseout="this.style.color='#667eea'">Products</a> > 
        <a href="{{ route('products.index', ['category' => $product->category->id]) }}" style="
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        " onmouseover="this.style.color='#764ba2'" onmouseout="this.style.color='#667eea'">{{ $product->category->name }}</a> > 
        <span style="color: #333; font-weight: 600;">{{ $product->name }}</span>
    </div>

    <!-- Product Detail Section -->
    <div style="
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        margin-bottom: 80px;
        background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        animation: fadeIn 0.8s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
    ">
        <!-- Product Images -->
        <div style="animation: slideInLeft 0.8s ease;">
            <div style="
                width: 100%;
                aspect-ratio: 1;
                background: linear-gradient(135deg, #f5f5f5 0%, #efefef 100%);
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.1);
                transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            "
            onmouseover="this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.3)'; this.style.transform='scale(1.02)'"
            onmouseout="this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)'; this.style.transform='scale(1)'">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
                    " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @else
                    <div style="
                        width: 100%;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #999;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        font-weight: 600;
                    ">
                        <span>No Image Available</span>
                    </div>
                @endif
            </div>

            @if ($product->images)
                <div style="
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 12px;
                    animation: fadeIn 0.8s ease 0.2s backwards;
                ">
                    @foreach (json_decode($product->images) as $image)
                        <div style="
                            aspect-ratio: 1;
                            background: #f5f5f5;
                            border-radius: 8px;
                            overflow: hidden;
                            cursor: pointer;
                            border: 2px solid transparent;
                            transition: all 0.3s ease;
                        "
                        onmouseover="
                            this.style.borderColor='#667eea';
                            this.style.boxShadow='0 6px 16px rgba(102, 126, 234, 0.3)';
                            this.style.transform='scale(1.05)';
                        "
                        onmouseout="
                            this.style.borderColor='transparent';
                            this.style.boxShadow='none';
                            this.style.transform='scale(1)';
                        ">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div style="animation: slideInRight 0.8s ease;">
            <h1 style="
                font-size: 32px;
                font-weight: 800;
                margin-bottom: 20px;
                background: linear-gradient(90deg, #1a1a1a 0%, #667eea 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: 0.5px;
            ">{{ $product->name }}</h1>
            
            <!-- Pricing Section -->
            <div style="
                margin-bottom: 25px;
                display: flex;
                align-items: center;
                gap: 20px;
                animation: slideInLeft 0.8s ease 0.1s backwards;
            ">
                <div style="display: flex; align-items: center; gap: 12px;">
                    @if ($product->compare_price && $product->compare_price > $product->price)
                        <span style="
                            color: #999;
                            text-decoration: line-through;
                            font-size: 18px;
                            font-weight: 500;
                        ">₹{{ number_format($product->compare_price, 0) }}</span>
                    @endif
                    <span style="
                        color: #ff0000;
                        font-size: 36px;
                        font-weight: 800;
                        animation: pulse 2s infinite;
                    ">₹{{ number_format($product->price, 0) }}</span>
                </div>
                @if ($product->compare_price && $product->compare_price > $product->price)
                    <div style="
                        background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
                        color: white;
                        padding: 8px 16px;
                        border-radius: 8px;
                        font-weight: bold;
                        font-size: 13px;
                        box-shadow: 0 4px 12px rgba(255, 0, 0, 0.3);
                        animation: bounce 1.5s infinite;
                    ">
                        {{ round(((($product->compare_price - $product->price) / $product->compare_price) * 100)) }}% OFF
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div style="
                margin-bottom: 30px;
                padding-bottom: 30px;
                border-bottom: 2px solid rgba(102, 126, 234, 0.2);
                animation: fadeIn 0.8s ease 0.2s backwards;
            ">
                <div style="color: #666; margin-bottom: 12px; font-size: 15px;">
                    <strong style="color: #1a1a1a;">SKU:</strong> {{ $product->sku }}
                </div>
                <div style="color: #666; margin-bottom: 12px; font-size: 15px;">
                    <strong style="color: #1a1a1a;">Category:</strong> 
                    <a href="{{ route('products.index', ['category' => $product->category->id]) }}" style="
                        color: #ff0000;
                        text-decoration: none;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        {{ $product->category->name }}
                    </a>
                </div>
                <div style="color: #666; font-size: 15px;">
                    <strong style="color: #1a1a1a;">Availability:</strong>
                    @if ($product->stock > 0)
                        <span style="
                            color: #28a745;
                            font-weight: bold;
                            animation: pulse 2s infinite;
                        ">✓ In Stock ({{ $product->stock }} available)</span>
                    @else
                        <span style="color: #f44336; font-weight: bold;">✗ Out of Stock</span>
                    @endif
                </div>
            </div>

            <p style="
                color: #666;
                line-height: 1.8;
                font-size: 16px;
                margin-bottom: 30px;
                animation: fadeIn 0.8s ease 0.3s backwards;
            ">{{ $product->short_description }}</p>

            <!-- Add to Cart Section -->
            @if ($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product) }}" style="
                    margin-bottom: 30px;
                    animation: fadeIn 0.8s ease 0.4s backwards;
                ">
                    @csrf
                    <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                        <div style="flex: 0 0 100px;">
                            <label style="
                                display: block;
                                margin-bottom: 8px;
                                font-weight: 600;
                                color: #1a1a1a;
                            ">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="
                                width: 100%;
                                padding: 12px;
                                border: 2px solid #e0e0e0;
                                border-radius: 8px;
                                font-size: 15px;
                                font-weight: 600;
                                text-align: center;
                                transition: all 0.3s ease;
                            " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                        </div>
                    </div>
                    <button type="submit" class="btn" style="
                        padding: 16px 40px;
                        font-size: 16px;
                        width: 100%;
                        letter-spacing: 0.5px;
                    ">🛒 Add to Cart</button>
                </form>
                <button style="
                    width: 100%;
                    padding: 14px;
                    background: transparent;
                    border: 2px solid #ff0000;
                    color: #ff0000;
                    border-radius: 8px;
                    cursor: pointer;
                    font-size: 15px;
                    font-weight: 600;
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                " onmouseover="this.style.background='#ff0000'; this.style.color='white'; this.style.boxShadow='0 8px 20px rgba(255, 0, 0, 0.3)'" onmouseout="this.style.background='transparent'; this.style.color='#ff0000'; this.style.boxShadow='none'">
                    ❤️ Add to Wishlist
                </button>
            @else
                <div style="
                    width: 100%;
                    padding: 20px;
                    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
                    border-radius: 8px;
                    text-align: center;
                    color: #721c24;
                    font-weight: 600;
                    border-left: 4px solid #dc3545;
                ">
                    Currently Out of Stock
                </div>
            @endif

            <!-- Shipping & Returns -->
            <div style="
                margin-top: 40px;
                padding-top: 30px;
                border-top: 2px solid rgba(102, 126, 234, 0.2);
                animation: fadeIn 0.8s ease 0.5s backwards;
            ">
                <h3 style="
                    margin-bottom: 18px;
                    color: #1a1a1a;
                    font-weight: 700;
                    font-size: 16px;
                ">📦 Shipping & Returns</h3>
                <ul style="
                    color: #666;
                    font-size: 14px;
                    line-height: 2;
                    list-style: none;
                    padding: 0;
                ">
                    <li style="transition: all 0.3s ease;" onmouseover="this.style.color='#667eea'; this.style.transform='translateX(5px)'" onmouseout="this.style.color='#666'; this.style.transform='translateX(0)'">✓ Free shipping on orders above ₹1499</li>
                    <li style="transition: all 0.3s ease;" onmouseover="this.style.color='#667eea'; this.style.transform='translateX(5px)'" onmouseout="this.style.color='#666'; this.style.transform='translateX(0)'">✓ Free 7-day returns (conditions apply)</li>
                    <li style="transition: all 0.3s ease;" onmouseover="this.style.color='#667eea'; this.style.transform='translateX(5px)'" onmouseout="this.style.color='#666'; this.style.transform='translateX(0)'">✓ Secure packaging</li>
                    <li style="transition: all 0.3s ease;" onmouseover="this.style.color='#667eea'; this.style.transform='translateX(5px)'" onmouseout="this.style.color='#666'; this.style.transform='translateX(0)'">✓ 100% authentic products</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Product Description -->
    <div style="
        background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 80px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        animation: fadeIn 0.8s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
    ">
        <h2 style="
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        ">📝 Product Description</h2>
        <div style="
            color: #666;
            line-height: 1.9;
            font-size: 15px;
        ">
            {!! nl2br($product->description) !!}
        </div>
    </div>

    <!-- Related Products -->
    @if ($related_products->count())
        <div style="margin-bottom: 80px;">
            <h2 class="section-title">🔗 Related Products</h2>
            <div class="products-grid">
                @foreach ($related_products as $related)
                    <div class="product-card">
                        <div class="product-image">
                            @if ($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                            @else
                                <div style="
                                    width: 100%;
                                    height: 100%;
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    font-weight: 600;
                                ">No Image</div>
                            @endif
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-name">{{ $related->name }}</h3>
                            
                            <div class="product-price">
                                @if ($related->compare_price && $related->compare_price > $related->price)
                                    <span class="original">₹{{ number_format($related->compare_price, 0) }}</span>
                                @endif
                                <span class="current">₹{{ number_format($related->price, 0) }}</span>
                            </div>
                            
                            <div class="product-actions">
                                <a href="{{ route('products.show', $related->slug) }}" class="btn" style="width: 100%; text-align: center;">View</a>
                                <form method="POST" action="{{ route('cart.add', $related) }}" style="width: 100%;">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn" style="width: 100%;">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Customer Reviews Section -->
    <div style="
        background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        animation: fadeIn 0.8s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
    ">
        <h2 style="
            margin-bottom: 35px;
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        ">⭐ Customer Reviews</h2>

        @if ($reviews->count())
            <div style="margin-bottom: 40px;">
                @foreach ($reviews as $review)
                    <div style="
                        padding: 25px;
                        margin-bottom: 20px;
                        background: white;
                        border-radius: 8px;
                        border-left: 4px solid #667eea;
                        transition: all 0.3s ease;
                        animation: fadeIn 0.6s ease backwards;
                    "
                    onmouseover="
                        this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.2)';
                        this.style.transform='translateX(5px)';
                    "
                    onmouseout="
                        this.style.boxShadow='none';
                        this.style.transform='translateX(0)';
                    ">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                            <div>
                                <strong style="
                                    color: #1a1a1a;
                                    font-size: 15px;
                                ">{{ $review->customer_name }}</strong>
                                <div style="
                                    color: #999;
                                    font-size: 13px;
                                    margin-top: 4px;
                                ">{{ $review->created_at->format('M d, Y') }}</div>
                            </div>
                            <div style="color: #ffc107; font-size: 14px;">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                        </div>
                        @if ($review->title)
                            <h4 style="
                                margin-bottom: 10px;
                                color: #667eea;
                                font-weight: 700;
                                font-size: 15px;
                            ">{{ $review->title }}</h4>
                        @endif
                        <p style="color: #666; margin: 0; line-height: 1.6;">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>

            @if ($reviews->hasPages())
                <div style="margin-top: 25px; text-align: center;">
                    {{ $reviews->links() }}
                </div>
            @endif
        @else
            <div style="
                text-align: center;
                padding: 40px;
                color: #999;
            ">
                No reviews yet. Be the first to review this product!
            </div>
        @endif

        <!-- Review Form -->
        <div style="
            margin-top: 50px;
            padding-top: 35px;
            border-top: 2px solid rgba(102, 126, 234, 0.2);
        ">
            <h3 style="
                margin-bottom: 25px;
                color: #1a1a1a;
                font-weight: 700;
                font-size: 18px;
            ">✍️ Leave a Review</h3>
            <form method="POST" action="{{ route('products.review', $product) }}">
                @csrf

                <div style="
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 20px;
                    margin-bottom: 20px;
                ">
                    <div style="animation: fadeIn 0.6s ease;">
                        <label style="
                            display: block;
                            margin-bottom: 8px;
                            font-weight: 600;
                            color: #1a1a1a;
                        ">Your Name *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #e0e0e0;
                            border-radius: 8px;
                            transition: all 0.3s ease;
                        " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                    </div>

                    <div style="animation: fadeIn 0.6s ease 0.1s backwards;">
                        <label style="
                            display: block;
                            margin-bottom: 8px;
                            font-weight: 600;
                            color: #1a1a1a;
                        ">Email *</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #e0e0e0;
                            border-radius: 8px;
                            transition: all 0.3s ease;
                        " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div style="
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 20px;
                    margin-bottom: 20px;
                ">
                    <div style="animation: fadeIn 0.6s ease 0.2s backwards;">
                        <label style="
                            display: block;
                            margin-bottom: 8px;
                            font-weight: 600;
                            color: #1a1a1a;
                        ">Rating *</label>
                        <select name="rating" required style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #e0e0e0;
                            border-radius: 8px;
                            transition: all 0.3s ease;
                        " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                            <option value="">Select Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Good</option>
                            <option value="3">⭐⭐⭐ Average</option>
                            <option value="2">⭐⭐ Poor</option>
                            <option value="1">⭐ Very Poor</option>
                        </select>
                    </div>

                    <div style="animation: fadeIn 0.6s ease 0.3s backwards;">
                        <label style="
                            display: block;
                            margin-bottom: 8px;
                            font-weight: 600;
                            color: #1a1a1a;
                        ">Review Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" maxlength="255" style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #e0e0e0;
                            border-radius: 8px;
                            transition: all 0.3s ease;
                        " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div style="margin-bottom: 20px; animation: fadeIn 0.6s ease 0.4s backwards;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                    ">Your Review</label>
                    <textarea name="comment" style="
                        width: 100%;
                        padding: 12px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        min-height: 140px;
                        transition: all 0.3s ease;
                        resize: vertical;
                    " onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 15px rgba(102, 126, 234, 0.2)'" onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">{{ old('comment') }}</textarea>
                </div>

                <button type="submit" class="btn" style="animation: fadeIn 0.6s ease 0.5s backwards;">✓ Submit Review</button>
            </form>
        </div>
    </div>
</div>
@endsection
