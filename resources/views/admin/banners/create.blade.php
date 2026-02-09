@extends('admin.layouts.base')

@section('title', 'Create Banner')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 20px;">Create New Banner</h2>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Banner Title *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="image">Banner Image * (Recommended: 1920x600px)</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <small style="color: #666; display: block; margin-top: 5px;">Max size: 5MB. Formats: JPEG, PNG, GIF, WebP</small>
        </div>

        <div class="form-group">
            <label for="link">Link URL</label>
            <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://example.com">
            <small style="color: #666; display: block; margin-top: 5px;">Where should this banner link to?</small>
        </div>

        <div class="form-group">
            <label for="button_text">Button Text</label>
            <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" placeholder="Shop Now">
            <small style="color: #666; display: block; margin-top: 5px;">Text for the call-to-action button (optional)</small>
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}">
            <small style="color: #666; display: block; margin-top: 5px;">Lower numbers appear first in the slider</small>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Create Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
