@extends('layouts.app')

@section('title', 'About Us - PRINTINGG NOVA')

@section('content')
<div class="container">
    <h1 style="
        margin: 60px 0 30px;
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: slideInLeft 0.8s ease;
        letter-spacing: 1px;
    ">About Us</h1>
    
    <div style="
        background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        animation: fadeIn 0.8s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
        line-height: 1.8;
        font-size: 16px;
        color: #333;
    ">
        {{ $page->content }}
    </div>

    <!-- Additional Info Section -->
    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 60px;
        margin-bottom: 60px;
    ">
        <div style="
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: slideInLeft 0.8s ease;
        "
        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.3)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.1)'">
            <h3 style="color: #667eea; font-size: 20px; margin-bottom: 15px; font-weight: 700;">🎯 Our Mission</h3>
            <p style="color: #666; line-height: 1.7; margin: 0;">
                To bring the magic of anime merchandise to fans around the world with high-quality products and exceptional customer service.
            </p>
        </div>

        <div style="
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.1);
            border-left: 4px solid #764ba2;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: slideInLeft 0.8s ease 0.1s backwards;
        "
        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(118, 75, 162, 0.3)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.1)'">
            <h3 style="color: #764ba2; font-size: 20px; margin-bottom: 15px; font-weight: 700;">⭐ Why Choose Us</h3>
            <p style="color: #666; line-height: 1.7; margin: 0;">
                Premium quality anime merchandise, fast shipping, authentic products, and a passionate team dedicated to anime fans.
            </p>
        </div>

        <div style="
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.1);
            border-left: 4px solid #ff0000;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: slideInLeft 0.8s ease 0.2s backwards;
        "
        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(255, 0, 0, 0.3)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.1)'">
            <h3 style="color: #ff0000; font-size: 20px; margin-bottom: 15px; font-weight: 700;">💝 Satisfaction Guaranteed</h3>
            <p style="color: #666; line-height: 1.7; margin: 0;">
                We offer hassle-free returns and refunds. Your satisfaction is our top priority and we stand behind every product.
            </p>
        </div>
    </div>
</div>
@endsection
