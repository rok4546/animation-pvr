@extends('admin.layouts.base')

@section('title', 'Products Report')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">📦 Products Report</h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.products') }}" style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label>Stock Status</label>
                <select name="stock_status" class="form-control">
                    <option value="">All Products</option>
                    <option value="in_stock" {{ request('stock_status') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="out_of_stock" {{ request('stock_status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="low_stock" {{ request('stock_status') === 'low_stock' ? 'selected' : '' }}>Low Stock (≤10)</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn">Filter</button>
                <a href="{{ route('admin.reports.products') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    <!-- Stats Cards -->
    <div class="stats">
        <div class="stat-card">
            <h3>Total Products</h3>
            <div class="number">{{ $total_products }}</div>
        </div>
        <div class="stat-card">
            <h3>In Stock</h3>
            <div class="number" style="color: #28a745;">{{ $in_stock }}</div>
        </div>
        <div class="stat-card">
            <h3>Out of Stock</h3>
            <div class="number" style="color: #dc3545;">{{ $out_of_stock }}</div>
        </div>
        <div class="stat-card">
            <h3>Low Stock</h3>
            <div class="number" style="color: #ffc107;">{{ $low_stock }}</div>
        </div>
    </div>

    <!-- Products Table -->
    <table class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Reviews</th>
                <th>Orders</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" style="color: #ff0000; text-decoration: none;">
                        {{ $product->name }}
                    </a>
                </td>
                <td>{{ $product->sku }}</td>
                <td>₹{{ number_format($product->price, 2) }}</td>
                <td>
                    <span style="
                        padding: 4px 8px;
                        border-radius: 4px;
                        font-size: 12px;
                        font-weight: bold;
                        background: 
                            @if($product->stock > 10) #d4edda
                            @elseif($product->stock > 0) #fff3cd
                            @else #f8d7da
                            @endif;
                        color: 
                            @if($product->stock > 10) #155724
                            @elseif($product->stock > 0) #856404
                            @else #721c24
                            @endif;
                    ">
                        {{ $product->stock }}
                    </span>
                </td>
                <td>{{ $product->reviews_count }}</td>
                <td>{{ $product->order_items_count }}</td>
                <td>
                    <span style="
                        padding: 4px 8px;
                        border-radius: 4px;
                        font-size: 12px;
                        font-weight: bold;
                        background: {{ $product->is_active ? '#d4edda' : '#f8d7da' }};
                        color: {{ $product->is_active ? '#155724' : '#721c24' }};
                    ">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection
