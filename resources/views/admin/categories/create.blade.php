@extends('admin.layouts.base')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')
<h2 style="margin-bottom: 30px;">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h2>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Category Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" style="min-height: 100px;">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Category Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if (isset($category) && $category->image)
                <p style="color: #666; font-size: 12px; margin-top: 5px;">Current: {{ basename($category->image) }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}" maxlength="255">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $category->meta_description ?? '') }}" maxlength="255">
        </div>

        <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
        </div>

        <div class="form-group" style="display: flex; align-items: center;">
            <label style="display: flex; align-items: center; margin-bottom: 0;">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) style="width: auto; margin-right: 10px;">
                <span>Active</span>
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">{{ isset($category) ? 'Update Category' : 'Create Category' }}</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
