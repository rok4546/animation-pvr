@extends('admin.layouts.base')

@section('title', 'Orders')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h2>Orders</h2>
</div>

<!-- Status Filter Tabs -->
<div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <p style="margin: 0 0 15px 0; font-weight: 600; color: #333;">Filter by Status:</p>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px;">
        <a href="{{ route('admin.orders.index') }}" style="
            padding: 15px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            background: {{ request('status') === null ? '#667eea' : '#f0f0f0' }};
            color: {{ request('status') === null ? 'white' : '#333' }};
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid {{ request('status') === null ? '#667eea' : '#ddd' }};
            cursor: pointer;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            📊 All Orders
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" style="
            padding: 15px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            background: {{ request('status') === 'pending' ? '#ffc107' : '#fff8e1' }};
            color: {{ request('status') === 'pending' ? 'white' : '#ff9800' }};
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid {{ request('status') === 'pending' ? '#ffc107' : '#ffd54f' }};
            cursor: pointer;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(255,152,0,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            ⏳ Pending
            @if($pendingCount = \App\Models\Order::where('status', 'pending')->count())
                <span style="background: white; color: #ff9800; padding: 2px 8px; border-radius: 20px; font-size: 12px; margin-left: 8px;">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" style="
            padding: 15px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            background: {{ request('status') === 'processing' ? '#2196f3' : '#e3f2fd' }};
            color: {{ request('status') === 'processing' ? 'white' : '#2196f3' }};
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid {{ request('status') === 'processing' ? '#2196f3' : '#90caf9' }};
            cursor: pointer;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(33,150,243,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            ⚙️ Processing
            @if($processingCount = \App\Models\Order::where('status', 'processing')->count())
                <span style="background: white; color: #2196f3; padding: 2px 8px; border-radius: 20px; font-size: 12px; margin-left: 8px;">{{ $processingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" style="
            padding: 15px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            background: {{ request('status') === 'delivered' ? '#4caf50' : '#e8f5e9' }};
            color: {{ request('status') === 'delivered' ? 'white' : '#4caf50' }};
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid {{ request('status') === 'delivered' ? '#4caf50' : '#81c784' }};
            cursor: pointer;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(76,175,80,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            ✅ Complete
            @if($completeCount = \App\Models\Order::where('status', 'delivered')->count())
                <span style="background: white; color: #4caf50; padding: 2px 8px; border-radius: 20px; font-size: 12px; margin-left: 8px;">{{ $completeCount }}</span>
            @endif
        </a>
    </div>
</div>

<!-- Search Bar -->
<div class="card" style="margin-bottom: 20px;">
    <form method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="🔍 Search by order # or email..." value="{{ request('search') }}" style="flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 4px;">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <button type="submit" class="btn" style="padding: 12px 20px; background: #667eea; color: white;">Search</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.orders.index') }}" class="btn" style="padding: 12px 20px; background: #999; color: white; text-decoration: none;">Clear</a>
        @endif
    </form>
</div>

<!-- Orders Table -->
<div class="card">

    @if ($orders->count())
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>
                            @if ($order->user)
                                {{ $order->user->name }}<br>
                                <small style="color: #999;">{{ $order->user->email }}</small>
                            @else
                                {{ $order->guest_email }}
                            @endif
                        </td>
                        <td>{{ $order->items->count() }} item(s)</td>
                        <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                        <td>
                            <span style="padding: 6px 12px; border-radius: 4px; background: 
                                @if ($order->status === 'pending') #ffc107
                                @elseif ($order->status === 'processing') #2196f3
                                @elseif ($order->status === 'shipped') #0066cc
                                @elseif ($order->status === 'delivered') #4caf50
                                @else #f44336
                                @endif;
                                color: white; font-size: 12px; font-weight: 600; display: inline-block;">
                                @if ($order->status === 'pending')
                                    ⏳ Pending
                                @elseif ($order->status === 'processing')
                                    ⚙️ Processing
                                @elseif ($order->status === 'shipped')
                                    📦 Shipped
                                @elseif ($order->status === 'delivered')
                                    ✅ Delivered
                                @else
                                    ✕ Cancelled
                                @endif
                            </span>
                        </td>
                        <td>
                            <span style="padding: 3px 8px; border-radius: 3px; background: 
                                @if ($order->payment_status === 'paid') #4caf50
                                @elseif ($order->payment_status === 'unpaid') #ffc107
                                @else #f44336
                                @endif;
                                color: white; font-size: 11px;">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $orders->links() }}
        </div>
    @else
        <p style="color: #999; text-align: center; padding: 40px;">No orders found</p>
    @endif
</div>
@endsection
