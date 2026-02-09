@extends('layouts.app')

@section('title', 'Order Confirmation - ANIME ARTISTRY')

@section('content')
<div class="container">
    <div style="background: white; padding: 40px; border-radius: 8px; text-align: center; max-width: 600px; margin: 40px auto;">
        <div style="font-size: 64px; margin-bottom: 20px; color: #4caf50;">✓</div>
        
        <h1 style="color: #333; margin-bottom: 15px;">Order Confirmed!</h1>
        <p style="color: #666; font-size: 16px; margin-bottom: 30px;">Thank you for your purchase. Your order has been successfully placed.</p>

        <div style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: left; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px;">Order Details</h3>
            
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                <span style="color: #999;">Order Number:</span>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                <span style="color: #999;">Order Date:</span>
                <strong>{{ $order->created_at->format('M d, Y H:i') }}</strong>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                <span style="color: #999;">Order Status:</span>
                <strong>{{ ucfirst($order->status) }}</strong>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                <span style="color: #999;">Payment Status:</span>
                <strong>{{ ucfirst($order->payment_status) }}</strong>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <span style="color: #999;">Total Amount:</span>
                <strong style="color: #ff0000; font-size: 18px;">₹{{ number_format($order->total, 2) }}</strong>
            </div>
        </div>

        <div style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: left; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px;">Order Items</h3>
            
            @foreach ($order->items as $item)
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                    <div>
                        <div>{{ $item->product_name }}</div>
                        <div style="color: #999; font-size: 12px;">SKU: {{ $item->product_sku }} | Qty: {{ $item->quantity }}</div>
                    </div>
                    <strong>₹{{ number_format($item->total, 2) }}</strong>
                </div>
            @endforeach
        </div>

        <div style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: left; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px;">Shipping Address</h3>
            <p style="color: #666; white-space: pre-wrap; line-height: 1.6;">{{ $order->shipping_address }}</p>
        </div>

        <div style="text-align: center; margin-bottom: 30px;">
            <p style="color: #666; margin-bottom: 20px;">A confirmation email has been sent to {{ $order->guest_email }}</p>
            
            <p style="color: #666; font-size: 14px; margin-bottom: 30px;">
                Your order will be processed and shipped within 2-3 business days.<br>
                You can track your order using the order number above.
            </p>
        </div>

        <div style="display: flex; gap: 10px; justify-content: center;">
            <a href="{{ route('home') }}" class="btn">Back to Home</a>
            <a href="{{ route('products.index') }}" class="btn btn-outline">Continue Shopping</a>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 8px; margin-top: 40px; max-width: 800px; margin-left: auto; margin-right: auto;">
        <h2 style="margin-bottom: 20px; font-size: 20px;">What's Next?</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">📦</div>
                <h3 style="margin-bottom: 10px;">Processing</h3>
                <p style="color: #666; font-size: 14px;">Your order is being prepared for shipment</p>
            </div>

            <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">🚚</div>
                <h3 style="margin-bottom: 10px;">Shipping</h3>
                <p style="color: #666; font-size: 14px;">We'll notify you once your order ships</p>
            </div>

            <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center;">
                <div style="font-size: 32px; margin-bottom: 10px;">📍</div>
                <h3 style="margin-bottom: 10px;">Delivery</h3>
                <p style="color: #666; font-size: 14px;">Receive your order within the estimated timeline</p>
            </div>
        </div>
    </div>
</div>
@endsection
