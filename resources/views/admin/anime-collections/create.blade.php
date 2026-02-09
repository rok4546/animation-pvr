@extends('admin.layouts.base')

@section('title', 'Create Anime Collection')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 20px;">Create New Anime Collection</h2>

    <form action="{{ route('admin.anime-collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Collection Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Collection Image</label>
            <input type="file" name="image" id="image" accept="image/*">
            <small style="color: #666; display: block; margin-top: 5px;">Recommended size: 500x500px</small>
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}">
            <small style="color: #666; display: block; margin-top: 5px;">Lower numbers appear first</small>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Create Collection</button>
            <a href="{{ route('admin.anime-collections.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
