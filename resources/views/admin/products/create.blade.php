@extends('admin.layouts.base')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<h2 style="margin-bottom: 30px;">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h2>

<div class="card" style="max-width: 800px;">
    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU *</label>
            <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category *</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" style="min-height: 80px;">{{ old('short_description', $product->short_description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" required>{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price *</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="compare_price">Compare Price (Old Price)</label>
            <input type="number" id="compare_price" name="compare_price" value="{{ old('compare_price', $product->compare_price ?? '') }}" step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="stock">Stock *</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '0') }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if (isset($product) && $product->image)
                <p style="color: #666; font-size: 12px; margin-top: 5px;">Current: {{ basename($product->image) }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}" maxlength="255">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description', $product->meta_description ?? '') }}" maxlength="255">
        </div>

        <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}">
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <label style="flex: 1; display: flex; align-items: center; margin-bottom: 0;">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false)) style="width: auto; margin-right: 10px;">
                <span>Featured Product</span>
            </label>
            <label style="flex: 1; display: flex; align-items: center; margin-bottom: 0;">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true)) style="width: auto; margin-right: 10px;">
                <span>Active</span>
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
