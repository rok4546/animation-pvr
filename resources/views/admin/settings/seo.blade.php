@extends('admin.layouts.base')

@section('title', 'SEO Settings')

@section('content')
<div class="card">
    <h2 style="margin: 0 0 20px 0;">🔍 SEO Settings</h2>

    <form method="POST" action="{{ route('admin.settings.seo.update') }}">
        @csrf

        <!-- Meta Tags -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">📝 Meta Tags</h3>
            
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" maxlength="60">
                <small style="color: #666; display: block; margin-top: 5px;">Recommended: 50-60 characters. This appears in search results.</small>
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                <small style="color: #666; display: block; margin-top: 5px;">Recommended: 150-160 characters. Brief description for search results.</small>
            </div>

            <div class="form-group">
                <label for="meta_keywords">Meta Keywords</label>
                <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}">
                <small style="color: #666; display: block; margin-top: 5px;">Comma-separated keywords (e.g., anime, merchandise, posters)</small>
            </div>
        </div>

        <!-- Analytics & Tracking -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">📊 Analytics & Tracking</h3>
            
            <div class="form-group">
                <label for="google_analytics">Google Analytics Tracking ID</label>
                <input type="text" id="google_analytics" name="google_analytics" value="{{ old('google_analytics', $settings['google_analytics'] ?? '') }}" placeholder="G-XXXXXXXXXX or UA-XXXXXXXXX-X">
                <small style="color: #666; display: block; margin-top: 5px;">Your Google Analytics measurement ID or tracking ID</small>
            </div>

            <div class="form-group">
                <label for="facebook_pixel">Facebook Pixel ID</label>
                <input type="text" id="facebook_pixel" name="facebook_pixel" value="{{ old('facebook_pixel', $settings['facebook_pixel'] ?? '') }}" placeholder="123456789012345">
                <small style="color: #666; display: block; margin-top: 5px;">Your Facebook Pixel ID for tracking conversions</small>
            </div>
        </div>

        <!-- SEO Tips -->
        <div style="background: #e7f3ff; padding: 20px; border-radius: 8px; border-left: 4px solid #2196F3; margin-bottom: 20px;">
            <h3 style="margin: 0 0 10px 0; font-size: 16px; color: #1976D2;">💡 SEO Best Practices</h3>
            <ul style="margin: 0; padding-left: 20px; color: #555;">
                <li>Keep meta titles under 60 characters</li>
                <li>Write compelling meta descriptions (150-160 characters)</li>
                <li>Use relevant keywords naturally</li>
                <li>Ensure each page has unique meta tags</li>
                <li>Monitor your analytics regularly</li>
            </ul>
        </div>

        <!-- Sitemap & Robots -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">🗺️ Sitemap & Robots.txt</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <p style="margin: 0 0 10px 0; font-weight: 500;">Sitemap URL:</p>
                    <code style="background: #fff; padding: 8px 12px; border-radius: 4px; display: block; color: #ff0000;">
                        {{ url('/sitemap.xml') }}
                    </code>
                    <small style="color: #666; display: block; margin-top: 5px;">Submit this to Google Search Console</small>
                </div>
                <div>
                    <p style="margin: 0 0 10px 0; font-weight: 500;">Robots.txt URL:</p>
                    <code style="background: #fff; padding: 8px 12px; border-radius: 4px; display: block; color: #ff0000;">
                        {{ url('/robots.txt') }}
                    </code>
                    <small style="color: #666; display: block; margin-top: 5px;">Controls search engine crawling</small>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
