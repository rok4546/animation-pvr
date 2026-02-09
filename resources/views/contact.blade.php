@extends('layouts.app')

@section('title', 'Contact Us - ANIME ARTISTRY')

@section('content')
<div class="container">
    <h1 style="
        margin: 60px 0 50px;
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: slideInLeft 0.8s ease;
        letter-spacing: 1px;
    ">Contact Us</h1>
    
    <div style="
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        max-width: 1200px;
        animation: fadeIn 0.8s ease;
    ">
        <!-- Contact Form -->
        <div>
            <h2 style="
                margin-bottom: 30px;
                font-size: 24px;
                font-weight: 700;
                color: #1a1a1a;
                animation: slideInLeft 0.8s ease 0.1s backwards;
            ">Get in Touch</h2>
            
            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                
                <div class="form-group" style="animation-delay: 0.1s;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                        font-size: 14px;
                    ">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="
                        width: 100%;
                        padding: 12px 15px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 14px;
                        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-family: inherit;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.2)'; this.style.transform='translateY(-2px)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)'">
                </div>

                <div class="form-group" style="animation-delay: 0.2s;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                        font-size: 14px;
                    ">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="
                        width: 100%;
                        padding: 12px 15px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 14px;
                        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-family: inherit;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.2)'; this.style.transform='translateY(-2px)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)'">
                </div>

                <div class="form-group" style="animation-delay: 0.3s;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                        font-size: 14px;
                    ">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" style="
                        width: 100%;
                        padding: 12px 15px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 14px;
                        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-family: inherit;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.2)'; this.style.transform='translateY(-2px)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)'">
                </div>

                <div class="form-group" style="animation-delay: 0.4s;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                        font-size: 14px;
                    ">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required style="
                        width: 100%;
                        padding: 12px 15px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 14px;
                        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-family: inherit;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.2)'; this.style.transform='translateY(-2px)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)'">
                </div>

                <div class="form-group" style="animation-delay: 0.5s;">
                    <label style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                        color: #1a1a1a;
                        font-size: 14px;
                    ">Message</label>
                    <textarea name="message" required style="
                        width: 100%;
                        padding: 12px 15px;
                        border: 2px solid #e0e0e0;
                        border-radius: 8px;
                        font-size: 14px;
                        min-height: 150px;
                        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-family: inherit;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                        resize: vertical;
                    "
                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 10px 30px rgba(102, 126, 234, 0.25)'; this.style.transform='translateY(-2px)'"
                    onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)'">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn" style="
                    width: 100%;
                    margin-top: 10px;
                    animation: slideInLeft 0.8s ease 0.6s backwards;
                ">📨 Send Message</button>
            </form>
        </div>

        <!-- Contact Information -->
        <div style="
            background: linear-gradient(135deg, white 0%, #f9f9f9 100%);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            animation: slideInRight 0.8s ease 0.1s backwards;
            border: 1px solid rgba(102, 126, 234, 0.1);
        ">
            <h2 style="
                margin-bottom: 30px;
                font-size: 24px;
                font-weight: 700;
                color: #1a1a1a;
            ">Contact Information</h2>
            
            <!-- Phone -->
            <div style="
                margin-bottom: 30px;
                padding-bottom: 25px;
                border-bottom: 2px solid #f0f0f0;
                animation: fadeIn 0.8s ease 0.2s backwards;
                transition: all 0.3s ease;
            "
            onmouseover="this.style.borderBottomColor='#667eea'; this.style.paddingLeft='15px'"
            onmouseout="this.style.borderBottomColor='#f0f0f0'; this.style.paddingLeft='0'">
                <h3 style="
                    margin-bottom: 10px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #667eea;
                ">📞 Phone</h3>
                <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.6;">+91 97809 93395</p>
            </div>

            <!-- Email -->
            <div style="
                margin-bottom: 30px;
                padding-bottom: 25px;
                border-bottom: 2px solid #f0f0f0;
                animation: fadeIn 0.8s ease 0.3s backwards;
                transition: all 0.3s ease;
            "
            onmouseover="this.style.borderBottomColor='#764ba2'; this.style.paddingLeft='15px'"
            onmouseout="this.style.borderBottomColor='#f0f0f0'; this.style.paddingLeft='0'">
                <h3 style="
                    margin-bottom: 10px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #764ba2;
                ">📧 Email</h3>
                <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.6;">
                    info@printingnova.com<br>
                    support@printingnova.com
                </p>
            </div>

            <!-- Address -->
            <div style="
                margin-bottom: 30px;
                padding-bottom: 25px;
                border-bottom: 2px solid #f0f0f0;
                animation: fadeIn 0.8s ease 0.4s backwards;
                transition: all 0.3s ease;
            "
            onmouseover="this.style.borderBottomColor='#ff0000'; this.style.paddingLeft='15px'"
            onmouseout="this.style.borderBottomColor='#f0f0f0'; this.style.paddingLeft='0'">
                <h3 style="
                    margin-bottom: 10px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #ff0000;
                ">📍 Address</h3>
                <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.6;">
                    West Bengal<br>
                    Kolkata<br>
                    Pincode: 743144<br>
                    India
                </p>
            </div>

            <!-- Business Hours -->
            <div style="
                margin-bottom: 30px;
                animation: fadeIn 0.8s ease 0.5s backwards;
                transition: all 0.3s ease;
            ">
                <h3 style="
                    margin-bottom: 10px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #1a1a1a;
                ">⏰ Business Hours</h3>
                <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.8;">
                    <strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM<br>
                    <strong>Saturday:</strong> 10:00 AM - 4:00 PM<br>
                    <strong>Sunday:</strong> Closed
                </p>
            </div>

            <!-- Social Links -->
            <div style="
                margin-top: 35px;
                padding-top: 30px;
                border-top: 2px solid rgba(102, 126, 234, 0.2);
                animation: fadeIn 0.8s ease 0.6s backwards;
            ">
                <h3 style="
                    margin-bottom: 20px;
                    font-size: 16px;
                    font-weight: 700;
                    color: #1a1a1a;
                ">Follow Us</h3>
                <div style="display: flex; gap: 15px;">
                    <a href="#" style="
                        display: inline-flex;
                        width: 45px;
                        height: 45px;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        text-decoration: none;
                        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-size: 18px;
                        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                    "
                    onmouseover="this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.5)'"
                    onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)'">f</a>
                    
                    <a href="#" style="
                        display: inline-flex;
                        width: 45px;
                        height: 45px;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        text-decoration: none;
                        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-size: 18px;
                        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                    "
                    onmouseover="this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.5)'"
                    onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)'">𝕏</a>
                    
                    <a href="#" style="
                        display: inline-flex;
                        width: 45px;
                        height: 45px;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        text-decoration: none;
                        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                        font-size: 18px;
                        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                    "
                    onmouseover="this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.5)'"
                    onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)'">📷</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
