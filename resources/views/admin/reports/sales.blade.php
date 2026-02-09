@extends('admin.layouts.base')

@section('title', 'Sales Report')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">💰 Sales Report</h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.sales') }}" style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div>
                <button type="submit" class="btn">Filter</button>
                <a href="{{ route('admin.reports.sales') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    <!-- Stats Cards -->
    <div class="stats">
        <div class="stat-card">
            <h3>Total Sales</h3>
            <div class="number">₹{{ number_format($total_sales, 2) }}</div>
        </div>
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="number">{{ $total_orders }}</div>
        </div>
        <div class="stat-card">
            <h3>Pending Orders</h3>
            <div class="number">{{ $pending_orders }}</div>
        </div>
        <div class="stat-card">
            <h3>Completed Orders</h3>
            <div class="number">{{ $completed_orders }}</div>
        </div>
        <div class="stat-card">
            <h3>Cancelled Orders</h3>
            <div class="number">{{ $cancelled_orders }}</div>
        </div>
    </div>

    <!-- Orders Table -->
    <table class="datatable">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Payment Status</th>
                <th>Order Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" style="color: #ff0000; text-decoration: none;">
                        #{{ $order->id }}
                    </a>
                </td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>{{ $order->items->count() }}</td>
                <td>₹{{ number_format($order->total, 2) }}</td>
                <td>
                    <span style="
                        padding: 4px 8px;
                        border-radius: 4px;
                        font-size: 12px;
                        font-weight: bold;
                        background: {{ $order->payment_status === 'paid' ? '#d4edda' : '#f8d7da' }};
                        color: {{ $order->payment_status === 'paid' ? '#155724' : '#721c24' }};
                    ">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
                <td>
                    <span style="
                        padding: 4px 8px;
                        border-radius: 4px;
                        font-size: 12px;
                        font-weight: bold;
                        background: 
                            @if($order->status === 'completed') #d4edda
                            @elseif($order->status === 'cancelled') #f8d7da
                            @elseif($order->status === 'pending') #fff3cd
                            @else #d1ecf1
                            @endif;
                        color: 
                            @if($order->status === 'completed') #155724
                            @elseif($order->status === 'cancelled') #721c24
                            @elseif($order->status === 'pending') #856404
                            @else #0c5460
                            @endif;
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
