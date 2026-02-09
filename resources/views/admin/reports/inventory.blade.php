@extends('admin.layouts.base')

@section('title', 'Inventory Report')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">📊 Inventory Report</h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.inventory') }}" style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: 1fr auto; gap: 15px; align-items: end;">
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
            <div>
                <button type="submit" class="btn">Filter</button>
                <a href="{{ route('admin.reports.inventory') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    <!-- Stats Cards -->
    <div class="stats">
        <div class="stat-card">
            <h3>Total Stock Value</h3>
            <div class="number">₹{{ number_format($total_stock_value ?? 0, 2) }}</div>
        </div>
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
    </div>

    <!-- Low Stock Alert -->
    @if($low_stock_items->count() > 0)
    <div class="alert" style="background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; margin-bottom: 30px;">
        <h3 style="margin: 0 0 10px 0;">⚠️ Low Stock Alert</h3>
        <p style="margin: 0;">The following {{ $low_stock_items->count() }} product(s) have low stock (≤10 units):</p>
        <ul style="margin: 10px 0 0 20px;">
            @foreach($low_stock_items->take(5) as $item)
                <li><strong>{{ $item->name }}</strong> - {{ $item->stock }} units remaining</li>
            @endforeach
            @if($low_stock_items->count() > 5)
                <li><em>...and {{ $low_stock_items->count() - 5 }} more</em></li>
            @endif
        </ul>
    </div>
    @endif

    <!-- Inventory Table -->
    <table class="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Stock Value</th>
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
                <td>{{ $product->category->name ?? 'N/A' }}</td>
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
                <td>₹{{ number_format($product->price * $product->stock, 2) }}</td>
                <td>
                    @if($product->stock > 10)
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; background: #d4edda; color: #155724;">
                            In Stock
                        </span>
                    @elseif($product->stock > 0)
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; background: #fff3cd; color: #856404;">
                            Low Stock
                        </span>
                    @else
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; background: #f8d7da; color: #721c24;">
                            Out of Stock
                        </span>
                    @endif
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
