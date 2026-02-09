@extends('admin.layouts.base')

@section('title', 'Products')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn">+ Add New Product</a>
</div>

<div class="card">
    <form method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" style="flex: 1;">
        <select name="category">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn">Search</button>
    </form>

    @if ($products->count())
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if ($product->is_featured)
                                <span style="color: #ff0000;">✓ Yes</span>
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            @if ($product->is_active)
                                <span style="color: #4caf50;">Active</span>
                            @else
                                <span style="color: #999;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline; margin-left: 5px;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    @else
        <p style="color: #999; text-align: center; padding: 40px;">No products found</p>
    @endif
</div>
@endsection
