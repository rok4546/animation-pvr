@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<div style="min-height: calc(100vh - 80px);">
    <!-- Page Header -->
    <div style="
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 20px;
        text-align: center;
        animation: slideInDown 0.8s ease;
        position: relative;
        overflow: hidden;
    ">
        <div style="
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
            pointer-events: none;
        "></div>
        <h1 style="
            margin: 0;
            font-size: 48px;
            font-weight: 800;
            animation: slideInLeft 0.8s ease;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        ">{{ $page->title }}</h1>
        <p style="
            margin: 15px 0 0 0;
            font-size: 16px;
            opacity: 0.95;
            animation: slideInRight 0.8s ease 0.1s backwards;
            position: relative;
            z-index: 1;
        ">Explore amazing products in our collection</p>
    </div>

    <!-- Page Content -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 60px 20px;">
        <div style="
            background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 60px;
            line-height: 1.8;
            font-size: 16px;
            color: #333;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        ">
            {!! nl2br(e($page->content)) !!}
        </div>

        <!-- Dropdowns/Categories Section -->
        @if($page->has_dropdowns && $page->dropdowns)
            <div style="margin-top: 70px;">
                @php
                    $dropdowns = is_string($page->dropdowns) ? json_decode($page->dropdowns, true) : $page->dropdowns;
                    // If a dropdown is selected via query parameter, filter only that one
                    if ($selectedDropdown) {
                        $dropdowns = array_filter($dropdowns, function($dropdown) use ($selectedDropdown) {
                            return Str::slug($dropdown['name']) === $selectedDropdown;
                        });
                    }
                @endphp
                @foreach($dropdowns as $dropdown)
                    <div style="
                        margin-bottom: 80px;
                        animation: fadeIn 0.8s ease backwards;
                    " id="dropdown-{{ Str::slug($dropdown['name']) }}">
                        <h2 style="
                            font-size: 36px;
                            font-weight: 800;
                            margin-bottom: 40px;
                            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                            padding-bottom: 20px;
                            border-bottom: 3px solid #667eea;
                            letter-spacing: 1px;
                            animation: slideInLeft 0.8s ease;
                        ">
                            {{ $dropdown['name'] }}
                        </h2>

                        @if(!empty($dropdown['product_ids']))
                            <div style="
                                display: grid;
                                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                                gap: 30px;
                                animation: fadeIn 0.8s ease 0.2s backwards;
                            ">
                                @foreach($dropdown['product_ids'] as $productId)
                                    @php
                                        $product = \App\Models\Product::find($productId);
                                    @endphp
                                    @if($product)
                                        <div style="
                                            background: white;
                                            border-radius: 12px;
                                            overflow: hidden;
                                            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                                            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                                            cursor: pointer;
                                            border: 1px solid rgba(102, 126, 234, 0.1);
                                        "
                                        onmouseover="
                                            this.style.transform='translateY(-12px)';
                                            this.style.boxShadow='0 16px 40px rgba(102, 126, 234, 0.3)';
                                            this.style.borderColor='#667eea';
                                        "
                                        onmouseout="
                                            this.style.transform='translateY(0)';
                                            this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)';
                                            this.style.borderColor='rgba(102, 126, 234, 0.1)';
                                        ">
                                            <!-- Product Image -->
                                            <div style="
                                                height: 240px;
                                                background: linear-gradient(135deg, #f5f5f5 0%, #efefef 100%);
                                                overflow: hidden;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                position: relative;
                                            ">
                                                @if($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="
                                                        width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;
                                                        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
                                                    " onmouseover="this.style.transform='scale(1.1) rotate(2deg)'" onmouseout="this.style.transform='scale(1) rotate(0deg)'">
                                                @else
                                                    <div style="
                                                        color: #999;
                                                        font-size: 14px;
                                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                                        width: 100%;
                                                        height: 100%;
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        color: white;
                                                        font-weight: 600;
                                                    ">No Image</div>
                                                @endif
                                            </div>

                                            <!-- Product Info -->
                                            <div style="padding: 20px;">
                                                <h3 style="
                                                    margin: 0 0 12px 0;
                                                    font-size: 16px;
                                                    font-weight: 700;
                                                    color: #1a1a1a;
                                                    white-space: nowrap;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    transition: color 0.3s ease;
                                                ">
                                                    {{ $product->name }}
                                                </h3>

                                                @if($product->description)
                                                    <p style="
                                                        margin: 0 0 15px 0;
                                                        color: #666;
                                                        font-size: 13px;
                                                        line-height: 1.5;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;
                                                        overflow: hidden;
                                                    ">
                                                        {{ $product->description }}
                                                    </p>
                                                @endif

                                                <!-- Price -->
                                                <div style="
                                                    display: flex;
                                                    align-items: baseline;
                                                    gap: 10px;
                                                    margin-bottom: 15px;
                                                ">
                                                    <span style="
                                                        font-size: 22px;
                                                        font-weight: 800;
                                                        color: #ff0000;
                                                    ">₹{{ number_format($product->price, 0) }}</span>
                                                    @if($product->original_price && $product->original_price > $product->price)
                                                        <span style="
                                                            font-size: 13px;
                                                            color: #999;
                                                            text-decoration: line-through;
                                                        ">₹{{ number_format($product->original_price, 0) }}</span>
                                                    @endif
                                                </div>

                                                <!-- Stock Status -->
                                                @if($product->stock > 0)
                                                    <p style="
                                                        margin: 0 0 15px 0;
                                                        color: #28a745;
                                                        font-size: 13px;
                                                        font-weight: 600;
                                                        animation: pulse 2s infinite;
                                                    ">
                                                        ✓ In Stock ({{ $product->stock }} available)
                                                    </p>
                                                @else
                                                    <p style="margin: 0 0 15px 0; color: #e74c3c; font-size: 13px; font-weight: 600;">
                                                        Out of Stock
                                                    </p>
                                                @endif

                                                <!-- Action Button -->
                                                <button style="
                                                    width: 100%;
                                                    padding: 10px;
                                                    background: #667eea;
                                                    color: white;
                                                    border: none;
                                                    border-radius: 4px;
                                                    font-size: 13px;
                                                    font-weight: 600;
                                                    cursor: pointer;
                                                    transition: background 0.3s;
                                                    {{ $product->stock <= 0 ? 'opacity: 0.5; cursor: not-allowed;' : '' }}
                                                " {{ $product->stock <= 0 ? 'disabled' : '' }} onmouseover="this.style.background='#5568d3'" onmouseout="this.style.background='#667eea'">
                                                    {{ $product->stock > 0 ? '🛒 Add to Cart' : 'Out of Stock' }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 8px; color: #999;">
                                No products in this category yet.
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    @media (max-width: 768px) {
        h1 {
            font-size: 32px !important;
        }

        h2 {
            font-size: 24px !important;
        }

        div[style*="grid-template-columns"] {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
            gap: 15px !important;
        }
    }
</style>
@endsection
