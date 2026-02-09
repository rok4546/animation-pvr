@extends('layouts.app')

@section('title', 'Home - ANIME ARTISTRY')

@section('content')

<!-- Hero Banner Carousel -->
<div class="hero-banner-section">
    <div class="hero-carousel" id="heroCarousel">
        @if(isset($banners) && $banners->count() > 0)
            @foreach($banners as $index => $banner)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(26,26,26,0.8)), url('{{ asset('storage/' . $banner->image) }}') center/cover;">
                    <div class="hero-content">
                        <h1 class="hero-title">{{ $banner->title }}</h1>
                        <p class="hero-subtitle">{{ $banner->subtitle ?? 'Discover Amazing Anime Merchandise' }}</p>
                        @if($banner->link)
                            <a href="{{ $banner->link }}" class="hero-btn">Shop Now</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <!-- Default Hero Slides -->
            <div class="hero-slide active" style="background: linear-gradient(135deg, rgba(102,126,234,0.9), rgba(118,75,162,0.9));">
                <div class="hero-content">
                    <h1 class="hero-title">Welcome to ANIME ARTISTRY</h1>
                    <p class="hero-subtitle">Your Ultimate Anime Merchandise Destination</p>
                    <a href="{{ route('products.index') }}" class="hero-btn">Explore Collection</a>
                </div>
            </div>
            <div class="hero-slide" style="background: linear-gradient(135deg, rgba(255,0,0,0.85), rgba(204,0,0,0.85));">
                <div class="hero-content">
                    <h1 class="hero-title">Exclusive Anime Collectibles</h1>
                    <p class="hero-subtitle">Limited Edition Figures & Merchandise</p>
                    <a href="{{ route('products.index') }}" class="hero-btn">Shop Now</a>
                </div>
            </div>
            <div class="hero-slide" style="background: linear-gradient(135deg, rgba(0,0,0,0.85), rgba(26,26,26,0.85));">
                <div class="hero-content">
                    <h1 class="hero-title">New Arrivals Every Week</h1>
                    <p class="hero-subtitle">Stay Updated with Latest Releases</p>
                    <a href="{{ route('products.index') }}" class="hero-btn">Discover More</a>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Carousel Navigation -->
    <button class="carousel-nav prev" onclick="changeSlide(-1)">❮</button>
    <button class="carousel-nav next" onclick="changeSlide(1)">❯</button>
    
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        @php $slideCount = isset($banners) && $banners->count() > 0 ? $banners->count() : 3; @endphp
        @for($i = 0; $i < $slideCount; $i++)
            <span class="indicator {{ $i === 0 ? 'active' : '' }}" onclick="goToSlide({{ $i }})"></span>
        @endfor
    </div>
</div>


<!-- Featured Products Grid -->
@if(isset($featured_products) && $featured_products->count() > 0)
<div class="featured-section">
    <div class="container">
        <h2 class="section-title-modern">
            <span class="title-icon">⭐</span>
            Featured Products
            <span class="title-underline"></span>
        </h2>
        <div class="products-grid">
            @foreach($featured_products as $product)
                <div class="product-card-modern">
                    <div class="product-image-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                        @else
                            <div class="product-no-image">No Image</div>
                        @endif
                        
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <div class="discount-badge">
                                -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                            </div>
                        @endif
                        
                        <div class="product-overlay">
                            <a href="{{ route('products.show', $product->slug) }}" class="quick-view-btn">Quick View</a>
                        </div>
                    </div>
                    
                    <div class="product-details">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-rating">
                            @for($i = 0; $i < 5; $i++)
                                <span class="star {{ $i < ($product->rating ?? 4) ? 'filled' : '' }}">★</span>
                            @endfor
                            <span class="rating-count">({{ $product->review_count ?? 0 }})</span>
                        </div>
                        <div class="product-price-wrapper">
                            @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="price-old">₹{{ number_format($product->compare_price, 0) }}</span>
                            @endif
                            <span class="price-current">₹{{ number_format($product->price, 0) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- New Arrivals Grid -->
@if(isset($new_products) && $new_products->count() > 0)
<div class="new-arrivals-section">
    <div class="container">
        <h2 class="section-title-modern">
            <span class="title-icon">✨</span>
            New Arrivals
            <span class="title-underline"></span>
        </h2>
        <div class="products-grid">
            @foreach($new_products as $product)
                <div class="product-card-modern">
                    <div class="product-image-wrapper">
                        <div class="new-badge">NEW</div>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                        @else
                            <div class="product-no-image">No Image</div>
                        @endif
                        
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <div class="discount-badge">
                                -{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%
                            </div>
                        @endif
                        
                        <div class="product-overlay">
                            <a href="{{ route('products.show', $product->slug) }}" class="quick-view-btn">Quick View</a>
                        </div>
                    </div>
                    
                    <div class="product-details">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-rating">
                            @for($i = 0; $i < 5; $i++)
                                <span class="star {{ $i < ($product->rating ?? 4) ? 'filled' : '' }}">★</span>
                            @endfor
                            <span class="rating-count">({{ $product->review_count ?? 0 }})</span>
                        </div>
                        <div class="product-price-wrapper">
                            @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="price-old">₹{{ number_format($product->compare_price, 0) }}</span>
                            @endif
                            <span class="price-current">₹{{ number_format($product->price, 0) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Promotional Banner -->
<div class="promo-banner">
    <div class="container">
        <div class="promo-content">
            <div class="promo-icon">🎁</div>
            <div class="promo-text">
                <h3>Special Offer!</h3>
                <p>Get FREE shipping on orders above ₹500</p>
            </div>
            <a href="{{ route('products.index') }}" class="promo-btn">Shop Now</a>
        </div>
    </div>
</div>

<style>
/* Hero Banner Styles */
.hero-banner-section {
    position: relative;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    height: 600px;
    overflow: hidden;
}

.hero-carousel {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-slide.active {
    opacity: 1;
    z-index: 1;
}

.hero-content {
    text-align: center;
    color: white;
    z-index: 2;
    animation: fadeInUp 1s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-title {
    font-size: 64px;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
    letter-spacing: 2px;
    animation: slideInLeft 0.8s ease;
}

.hero-subtitle {
    font-size: 24px;
    margin-bottom: 40px;
    opacity: 0.95;
    animation: slideInRight 0.8s ease;
}

.hero-btn {
    display: inline-block;
    padding: 18px 45px;
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 10px 30px rgba(255, 0, 0, 0.4);
    animation: bounce 2s infinite;
}

.hero-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 40px rgba(255, 0, 0, 0.6);
}

.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    color: #000;
    font-weight: bold;
}

.carousel-nav:hover {
    background: #ff0000;
    color: white;
    transform: translateY(-50%) scale(1.1);
}

.carousel-nav.prev {
    left: 30px;
}

.carousel-nav.next {
    right: 30px;
}

.carousel-indicators {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.indicator.active,
.indicator:hover {
    background: #ff0000;
    transform: scale(1.3);
}

/* Modern Section Title */
.section-title-modern {
    text-align: center;
    font-size: 48px;
    font-weight: 900;
    margin: 80px 0 50px;
    position: relative;
    display: inline-block;
    width: 100%;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-icon {
    font-size: 40px;
    margin-right: 15px;
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}

.title-underline {
    display: block;
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    margin: 15px auto 0;
    border-radius: 2px;
}

/* Categories Carousel */
.categories-showcase {
    background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
    padding: 60px 0;
    margin: 60px 0;
}

.categories-carousel-wrapper {
    position: relative;
    overflow: hidden;
}

.categories-carousel {
    display: flex;
    gap: 25px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 20px 0;
    scrollbar-width: none;
}

.categories-carousel::-webkit-scrollbar {
    display: none;
}

.category-item {
    flex: 0 0 180px;
    text-align: center;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.category-icon-wrapper {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 4px solid transparent;
}

.category-item:hover .category-icon-wrapper {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 20px 50px rgba(102, 126, 234, 0.4);
    border-color: #667eea;
}

.category-icon-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.category-item:hover .category-icon-wrapper img {
    transform: scale(1.1) rotate(5deg);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-size: 64px;
    font-weight: 900;
}

.category-name {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
    transition: color 0.3s ease;
}

.category-item:hover .category-name {
    color: #667eea;
}

.category-count {
    font-size: 14px;
    color: #999;
}

/* Products Carousel */
.featured-section,
.new-arrivals-section {
    padding: 60px 0;
}

.new-arrivals-section {
    background: linear-gradient(135deg, #f5f5f5 0%, #efefef 100%);
}

.products-carousel-wrapper {
    position: relative;
    padding: 0 60px;
}

.products-carousel {
    display: flex;
    gap: 25px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 20px 0;
    scrollbar-width: none;
}

.products-carousel::-webkit-scrollbar {
    display: none;
}

.product-card-modern {
    flex: 0 0 240px;
    background: white;
    border-radius: 0;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.product-card-modern:hover {
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    transform: translateY(-3px);
}

.product-image-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: #f0f0f0;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card-modern:hover .product-img {
    transform: scale(1.05);
}

.product-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e0e0e0;
    color: #999;
    font-weight: 600;
}

.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #cc0000;
    color: white;
    padding: 6px 12px;
    border-radius: 0;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.new-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #1a1a1a;
    color: white;
    padding: 6px 12px;
    border-radius: 0;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card-modern:hover .product-overlay {
    opacity: 1;
}

.quick-view-btn {
    padding: 10px 25px;
    background: #cc0000;
    color: white;
    text-decoration: none;
    border: none;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.quick-view-btn:hover {
    background: white;
    color: #cc0000;
}

.product-details {
    padding: 12px;
}

.product-title {
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 6px;
    height: 28px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 1.3;
}

.product-rating {
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 3px;
}

.star {
    color: #ddd;
    font-size: 13px;
}

.star.filled {
    color: #ffc107;
}

.rating-count {
    font-size: 11px;
    color: #999;
    margin-left: 3px;
}

.product-price-wrapper {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.price-old {
    color: #999;
    text-decoration: line-through;
    font-size: 12px;
}

.price-current {
    color: #1a1a1a;
    font-size: 16px;
    font-weight: 700;
}

.product-actions-modern {
    display: none;
}

.carousel-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    z-index: 10;
    color: #000;
    font-weight: bold;
}

.carousel-control:hover {
    background: #667eea;
    color: white;
    transform: translateY(-50%) scale(1.1);
}

.carousel-control.left {
    left: 0;
}

.carousel-control.right {
    right: 0;
}

/* Promo Banner */
.promo-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 0;
    margin: 80px 0;
}

.promo-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    flex-wrap: wrap;
}

.promo-icon {
    font-size: 64px;
    animation: bounce 2s infinite;
}

.promo-text {
    flex: 1;
    color: white;
}

.promo-text h3 {
    font-size: 32px;
    font-weight: 900;
    margin-bottom: 8px;
}

.promo-text p {
    font-size: 18px;
    opacity: 0.95;
}

.promo-btn {
    padding: 15px 40px;
    background: white;
    color: #667eea;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    transition: all 0.3s ease;
}

.promo-btn:hover {
    background: #ff0000;
    color: white;
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 36px;
    }
    
    .hero-subtitle {
        font-size: 16px;
    }
    
    .section-title-modern {
        font-size: 32px;
    }
    
    .carousel-nav {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .carousel-nav.prev {
        left: 10px;
    }
    
    .carousel-nav.next {
        right: 10px;
    }
    
    .products-carousel-wrapper {
        padding: 0 50px;
    }
    
    .carousel-control {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .promo-content {
        text-align: center;
        justify-content: center;
    }
    
    .promo-text h3 {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .hero-banner-section {
        height: 300px;
    }

    .hero-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .hero-subtitle {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .hero-btn {
        padding: 12px 20px;
        font-size: 13px;
    }

    .section-title-modern {
        font-size: 24px;
        margin: 30px 0 20px;
    }

    .title-icon {
        font-size: 28px;
        margin-right: 8px;
    }

    .carousel-nav {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }

    .carousel-control {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }

    .products-carousel-wrapper {
        padding: 0 30px;
    }

    .product-card-modern {
        flex: 0 0 240px;
    }

    .category-item {
        flex: 0 0 140px;
    }

    .category-icon-wrapper {
        width: 140px;
        height: 140px;
    }

    .promo-content {
        flex-direction: column;
    }

    .promo-icon {
        font-size: 48px;
    }

    .promo-text h3 {
        font-size: 20px;
    }

    .promo-text p {
        font-size: 14px;
    }

    .promo-btn {
        padding: 12px 24px;
        font-size: 13px;
        width: 100%;
    }
}

/* Enhanced animations for home page */
.hero-slide.active {
    animation: slideInCenter 1s ease-in-out;
}

@keyframes slideInCenter {
    from {
        opacity: 0;
        transform: scale(0.98);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Staggered animation for carousel items */
.product-card-modern {
    animation: slideInUp 0.6s ease-out backwards;
}

/* Category items animation */
.category-item {
    animation: zoomIn 0.6s ease-out backwards;
}

.category-item:nth-child(1) { animation-delay: 0.1s; }
.category-item:nth-child(2) { animation-delay: 0.2s; }
.category-item:nth-child(3) { animation-delay: 0.3s; }
.category-item:nth-child(4) { animation-delay: 0.4s; }
.category-item:nth-child(5) { animation-delay: 0.5s; }

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Smooth parallax effect for hero */
.hero-banner-section {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

/* Touch-friendly interactions */
@media (hover: none) and (pointer: coarse) {
    .product-card-modern:active {
        transform: scale(0.98);
    }

    .category-item:active {
        transform: scale(0.95);
    }

    button:active,
    .btn:active {
        transform: scale(0.95);
    }
}

/* Products Grid Layout */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

@media (max-width: 1024px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 0 15px;
    }
}

@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding: 0 10px;
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
        gap: 10px;
        padding: 0 10px;
    }
}

.product-card-modern {
    flex: unset;
}
</style>

<script>
// Hero Carousel Auto-play
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');
const indicators = document.querySelectorAll('.indicator');

function changeSlide(direction) {
    if(!slides.length) return;
    
    slides[currentSlide].classList.remove('active');
    if(indicators[currentSlide]) indicators[currentSlide].classList.remove('active');
    
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    
    slides[currentSlide].classList.add('active');
    if(indicators[currentSlide]) indicators[currentSlide].classList.add('active');
}

function goToSlide(index) {
    if(!slides.length) return;
    
    slides[currentSlide].classList.remove('active');
    if(indicators[currentSlide]) indicators[currentSlide].classList.remove('active');
    
    currentSlide = index;
    
    slides[currentSlide].classList.add('active');
    if(indicators[currentSlide]) indicators[currentSlide].classList.add('active');
}

// Auto-play every 5 seconds
if(slides.length > 0) {
    setInterval(() => {
        changeSlide(1);
    }, 5000);
}

// Product Carousel Scroll
function scrollCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    if(carousel) {
        const scrollAmount = 305; // card width + gap
        carousel.scrollLeft += direction * scrollAmount;
    }
}
</script>

@endsection
