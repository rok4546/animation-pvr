@extends('admin.layouts.base')

@section('title', 'Order Details')

@section('content')
<div style="margin-bottom: 30px;">
    <a href="{{ route('admin.orders.index') }}" style="color: #ff0000; text-decoration: none;">← Back to Orders</a>
    <h2 style="margin-top: 10px;">Order {{ $order->order_number }}</h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <h3 style="margin-bottom: 15px;">Order Information</h3>
        <div style="margin-bottom: 15px;">
            <strong>Order Number:</strong> {{ $order->order_number }}<br>
            <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}<br>
            <strong>Customer:</strong>
            @if ($order->user)
                {{ $order->user->name }}<br>
                <strong>Email:</strong> {{ $order->user->email }}<br>
                <strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}
            @else
                <strong>Email:</strong> {{ $order->guest_email }}
            @endif
        </div>

        <h3 style="margin-top: 20px; margin-bottom: 15px;">Order Status</h3>
        
        <!-- Status Progression Visual -->
        <div style="background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 0; margin-bottom: 20px;">
                @php
                    $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                    $statusLabels = [
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled'
                    ];
                    $statusColors = [
                        'pending' => '#ffc107',
                        'processing' => '#2196f3',
                        'shipped' => '#0066cc',
                        'delivered' => '#4caf50',
                        'cancelled' => '#f44336'
                    ];
                    $currentIndex = array_search($order->status, $statuses);
                @endphp
                
                @foreach($statuses as $index => $status)
                    <div style="flex: 1; text-align: center; position: relative;">
                        <div style="
                            width: 50px;
                            height: 50px;
                            margin: 0 auto 10px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: {{ ($index <= $currentIndex && $order->status !== 'cancelled') ? $statusColors[$status] : '#ddd' }};
                            color: white;
                            font-weight: bold;
                            transition: all 0.3s;
                        ">
                            {{ $index + 1 }}
                        </div>
                        <span style="font-size: 12px; font-weight: 500; display: block;">{{ ucfirst($status) }}</span>
                    </div>
                    @if($index < count($statuses) - 1)
                        <div style="flex: 0.5; height: 3px; background: {{ ($index < $currentIndex && $order->status !== 'cancelled') ? $statusColors[$status] : '#ddd' }}; margin-bottom: 40px;"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Quick Status Update Buttons -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;">
            @if($order->status === 'pending')
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: contents;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="processing">
                    <button type="submit" class="btn" style="background: #2196f3; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        → Move to Processing
                    </button>
                </form>
            @elseif($order->status === 'processing')
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: contents;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="shipped">
                    <button type="submit" class="btn" style="background: #0066cc; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        → Mark as Shipped
                    </button>
                </form>
            @elseif($order->status === 'shipped')
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: contents;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="delivered">
                    <button type="submit" class="btn" style="background: #4caf50; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                        ✓ Mark as Delivered
                    </button>
                </form>
            @endif

            @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: contents;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="btn" style="background: #f44336; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;" onclick="return confirm('Are you sure you want to cancel this order?');">
                        ✕ Cancel Order
                    </button>
                </form>
            @endif
        </div>

        <!-- Manual Status Dropdown (Advanced) -->
        <details style="margin-bottom: 15px;">
            <summary style="cursor: pointer; padding: 10px; background: #f0f0f0; border-radius: 4px; font-weight: 600;">
                Manual Status Change
            </summary>
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="margin-top: 15px;">
                @csrf
                @method('PUT')
                <div style="display: flex; gap: 10px;">
                    <select name="status" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="pending" @selected($order->status === 'pending')>Pending</option>
                        <option value="processing" @selected($order->status === 'processing')>Processing</option>
                        <option value="shipped" @selected($order->status === 'shipped')>Shipped</option>
                        <option value="delivered" @selected($order->status === 'delivered')>Delivered</option>
                        <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                    </select>
                    <button type="submit" class="btn" style="padding: 10px 15px;">Update</button>
                </div>
            </form>
        </details>

        <h3 style="margin-top: 20px; margin-bottom: 15px;">Payment Status</h3>
        <form method="POST" action="{{ route('admin.orders.updatePaymentStatus', $order) }}" style="margin-bottom: 15px;">
            @csrf
            @method('PUT')
            <div style="display: flex; gap: 10px;">
                <select name="payment_status" style="flex: 1;">
                    <option value="unpaid" @selected($order->payment_status === 'unpaid')>Unpaid</option>
                    <option value="paid" @selected($order->payment_status === 'paid')>Paid</option>
                    <option value="failed" @selected($order->payment_status === 'failed')>Failed</option>
                </select>
                <button type="submit" class="btn" style="padding: 10px 15px;">Update</button>
            </div>
        </form>

        <h3 style="margin-top: 20px; margin-bottom: 15px;">Tracking</h3>
        <form method="POST" action="{{ route('admin.orders.updateTracking', $order) }}">
            @csrf
            @method('PUT')
            <div style="display: flex; gap: 10px;">
                <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="Enter tracking number" style="flex: 1;">
                <button type="submit" class="btn" style="padding: 10px 15px;">Update</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 15px;">Shipping Address</h3>
        <p style="white-space: pre-wrap; color: #666;">{{ $order->shipping_address }}</p>

        <h3 style="margin-top: 20px; margin-bottom: 15px;">Billing Address</h3>
        <p style="white-space: pre-wrap; color: #666;">{{ $order->billing_address }}</p>

        @if ($order->customer_notes)
            <h3 style="margin-top: 20px; margin-bottom: 15px;">Customer Notes</h3>
            <p style="color: #666;">{{ $order->customer_notes }}</p>
        @endif
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <h3 style="margin-bottom: 15px;">Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->product_sku }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card" style="margin-top: 20px; max-width: 400px;">
    <h3 style="margin-bottom: 15px;">Order Summary</h3>
    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
        <strong>Subtotal:</strong>
        <span>₹{{ number_format($order->subtotal, 2) }}</span>
    </div>
    @if ($order->tax > 0)
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <strong>Tax:</strong>
            <span>₹{{ number_format($order->tax, 2) }}</span>
        </div>
    @endif
    @if ($order->shipping > 0)
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <strong>Shipping:</strong>
            <span>₹{{ number_format($order->shipping, 2) }}</span>
        </div>
    @endif
    @if ($order->discount > 0)
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #4caf50;">
            <strong>Discount:</strong>
            <span>-₹{{ number_format($order->discount, 2) }}</span>
        </div>
    @endif
    <hr style="margin: 15px 0; border: 1px solid #ddd;">
    <div style="display: flex; justify-content: space-between; font-size: 18px;">
        <strong>Total:</strong>
        <span style="color: #ff0000;">₹{{ number_format($order->total, 2) }}</span>
    </div>
</div>
@endsection
