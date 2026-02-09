@extends('admin.layouts.base')

@section('title', isset($page) ? 'Edit Page' : 'Create Page')

@section('content')
<div class="container">
    <h2>{{ isset($page) ? 'Edit Page' : 'Create New Page' }}</h2>

    <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($page))
            @method('PUT')
        @endif

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="title" style="display: block; margin-bottom: 5px; font-weight: 500;">Page Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $page->title ?? '') }}" required style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            ">
            @error('title')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 10px; font-weight: 500;">
                <input type="checkbox" id="has_dropdowns" name="has_dropdowns" value="1" {{ old('has_dropdowns', $page->has_dropdowns ?? false) ? 'checked' : '' }} onchange="toggleDropdownSection()">
                <span>Does this page have dropdown categories?</span>
            </label>
        </div>

        <!-- Dropdowns Section -->
        <div id="dropdownSection" style="display: none; background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 2px solid #ddd;">
            <h3 style="margin-bottom: 20px;">Page Dropdowns/Categories</h3>
            
            <div id="dropdownsContainer">
                @if(isset($page) && $page->dropdowns)
                    @php
                        $dropdowns = is_string($page->dropdowns) ? json_decode($page->dropdowns, true) : $page->dropdowns;
                    @endphp
                    @foreach($dropdowns as $index => $dropdown)
                        <div class="dropdown-item" style="background: white; padding: 15px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #ddd;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h4>Dropdown #{{ $index + 1 }}</h4>
                                <button type="button" class="btn btn-danger" onclick="removeDropdown(this)" style="padding: 5px 10px;">Remove</button>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Dropdown Name *</label>
                                <input type="text" name="dropdowns[{{ $index }}][name]" class="dropdown-name-input" value="{{ $dropdown['name'] ?? '' }}" required style="
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    font-size: 14px;
                                ">
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Select Products for this category</label>
                                <select name="dropdowns[{{ $index }}][product_ids][]" class="product-select" multiple style="
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    font-size: 14px;
                                    min-height: 150px;
                                " onchange="autoPopulateDropdownName(this)">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ in_array($product->id, $dropdown['product_ids'] ?? []) ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="button" class="btn" onclick="addDropdown()" style="margin-top: 15px;">+ Add Dropdown Category</button>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="content" style="display: block; margin-bottom: 5px; font-weight: 500;">Page Content *</label>
            <textarea id="content" name="content" required style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
                min-height: 300px;
                font-family: monospace;
            ">{{ old('content', $page->content ?? '') }}</textarea>
            @error('content')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 20px;">SEO Settings</h3>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="meta_title" style="display: block; margin-bottom: 5px; font-weight: 500;">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            ">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="meta_description" style="display: block; margin-bottom: 5px; font-weight: 500;">Meta Description</label>
            <textarea id="meta_description" name="meta_description" style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
                min-height: 80px;
            ">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="meta_keywords" style="display: block; margin-bottom: 5px; font-weight: 500;">Meta Keywords</label>
            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}" placeholder="keyword1, keyword2, keyword3" style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            ">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
                <span>Active (Show on website)</span>
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">{{ isset($page) ? 'Update Page' : 'Create Page' }}</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary" style="text-decoration: none; display: inline-block;">Cancel</a>
        </div>
    </form>
</div>

<script>
    let dropdownCount = {{ isset($page) && $page->dropdowns ? count($page->dropdowns) : 0 }};

    // Product data for auto-population
    const productsData = {
        @foreach($products as $product)
            {{ $product->id }}: '{{ $product->name }}',
        @endforeach
    };

    function toggleDropdownSection() {
        const section = document.getElementById('dropdownSection');
        const checkbox = document.getElementById('has_dropdowns');
        section.style.display = checkbox.checked ? 'block' : 'none';
    }

    function autoPopulateDropdownName(selectElement) {
        const selectedOptions = Array.from(selectElement.selectedOptions);
        const dropdownItem = selectElement.closest('.dropdown-item');
        const nameInput = dropdownItem.querySelector('.dropdown-name-input');
        
        if (selectedOptions.length === 0) {
            nameInput.value = '';
            return;
        }

        // Create name from selected product names
        const productNames = selectedOptions.map(option => option.text);
        
        // If only one product selected, use its name
        if (productNames.length === 1) {
            nameInput.value = productNames[0];
        } else {
            // If multiple products, find common category or use "Multi-Category"
            const commonWords = productNames[0].split(' ').filter(word => 
                productNames.every(name => name.includes(word))
            );
            
            if (commonWords.length > 0) {
                nameInput.value = commonWords.join(' ');
            } else {
                nameInput.value = `${productNames.length} Selected Items`;
            }
        }
    }

    function addDropdown() {
        const container = document.getElementById('dropdownsContainer');
        const html = `
            <div class="dropdown-item" style="background: white; padding: 15px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #ddd;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h4>Dropdown #${dropdownCount + 1}</h4>
                    <button type="button" class="btn btn-danger" onclick="removeDropdown(this)" style="padding: 5px 10px;">Remove</button>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Dropdown Name *</label>
                    <input type="text" name="dropdowns[${dropdownCount}][name]" class="dropdown-name-input" required style="
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        font-size: 14px;
                    " placeholder="e.g., Weapons, Figurines, etc.">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Select Products for this category</label>
                    <select name="dropdowns[${dropdownCount}][product_ids][]" class="product-select" multiple style="
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        font-size: 14px;
                        min-height: 150px;
                    " onchange="autoPopulateDropdownName(this)">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <small style="color: #666;">Hold Ctrl (or Cmd) to select multiple</small>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        dropdownCount++;
    }

    function removeDropdown(button) {
        button.closest('.dropdown-item').remove();
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleDropdownSection();
    });
</script>

<style>
    .form-group {
        margin-bottom: 20px;
    }

    .btn-danger {
        background: #d32f2f;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-danger:hover {
        background: #b71c1c;
    }
</style>
    </form>
</div>
@endsection
