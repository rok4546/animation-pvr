@extends('admin.layouts.base')

@section('title', 'Edit Banner')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 20px;">Edit Banner</h2>

    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Banner Title *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Banner Image (Recommended: 1920x600px)</label>
            @if($banner->image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*">
            <small style="color: #666; display: block; margin-top: 5px;">Leave empty to keep current image. Max size: 5MB</small>
        </div>

        <div class="form-group">
            <label for="link">Link URL</label>
            <input type="url" name="link" id="link" value="{{ old('link', $banner->link) }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label for="button_text">Button Text</label>
            <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $banner->button_text) }}" placeholder="Shop Now">
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $banner->sort_order) }}">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Update Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
