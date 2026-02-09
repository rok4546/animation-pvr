@extends('admin.layouts.base')

@section('title', 'Dashboard')

@section('content')
<h2 style="margin-bottom: 30px;">Dashboard</h2>

<div class="stats">
    <div class="stat-card">
        <h3>Total Orders</h3>
        <div class="number">{{ $total_orders }}</div>
    </div>
    <div class="stat-card">
        <h3>Pending Orders</h3>
        <div class="number">{{ $pending_orders }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Products</h3>
        <div class="number">{{ $total_products }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Categories</h3>
        <div class="number">{{ $total_categories }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Customers</h3>
        <div class="number">{{ $total_customers }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Revenue</h3>
        <div class="number" style="font-size: 24px;">₹{{ number_format($total_revenue, 0) }}</div>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom: 20px;">Recent Orders</h3>
    @if ($recent_orders->count())
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recent_orders as $order)
                    <tr>
                        <td><a href="{{ route('admin.orders.show', $order) }}" style="color: #ff0000; text-decoration: none;">{{ $order->order_number }}</a></td>
                        <td>
                            @if ($order->user)
                                {{ $order->user->name }}
                            @else
                                {{ $order->guest_email }}
                            @endif
                        </td>
                        <td>₹{{ number_format($order->total, 2) }}</td>
                        <td>
                            <span style="padding: 5px 10px; border-radius: 3px; background: 
                                @if ($order->status === 'pending') #ffc107
                                @elseif ($order->status === 'processing') #2196f3
                                @elseif ($order->status === 'shipped') #0066cc
                                @elseif ($order->status === 'delivered') #4caf50
                                @else #f44336
                                @endif;
                                color: white; font-size: 12px;">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999;">No orders yet</p>
    @endif
</div>

<div class="card">
    <h3 style="margin-bottom: 20px;">Top Rated Products</h3>
    @if ($top_products->count())
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Reviews</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($top_products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->review_count }} reviews</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999;">No products yet</p>
    @endif
</div>
@endsection
