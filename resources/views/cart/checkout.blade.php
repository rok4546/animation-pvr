@extends('layouts.app')

@section('title', 'Checkout - ANIME ARTISTRY')

@section('content')
<div class="container">
    <h1 style="margin: 40px 0;">Checkout</h1>

    <form method="POST" action="{{ route('cart.process') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 30px;">
            <div>
                <div class="card" style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; margin-bottom: 20px;">Billing Information</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Full Name *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Email Address *</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Phone Number *</label>
                        <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Billing Address *</label>
                        <textarea name="billing_address" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;">{{ old('billing_address') }}</textarea>
                    </div>
                </div>

                <div class="card" style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; margin-bottom: 20px;">Shipping Information</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Shipping Address *</label>
                        <textarea name="shipping_address" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;">{{ old('shipping_address') }}</textarea>
                    </div>
                </div>

                <div class="card" style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="font-size: 18px; margin-bottom: 20px;">Additional Information</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 500;">Order Notes (Optional)</label>
                        <textarea name="customer_notes" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; min-height: 80px; resize: vertical;">{{ old('customer_notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="font-size: 16px; margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 15px;">Order Review</h2>

                    @foreach ($items as $item)
                        <div style="display: flex; gap: 12px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #ddd;">
                            @if ($item['product']->image)
                                <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            @else
                                <div style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 4px;"></div>
                            @endif
                            <div style="flex: 1; font-size: 13px;">
                                <div style="font-weight: 600;">{{ $item['product']->name }}</div>
                                <div style="color: #999;">Qty: {{ $item['quantity'] }}</div>
                                <div style="color: #ff0000; font-weight: 600;">₹{{ number_format($item['subtotal'], 0) }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div style="margin-bottom: 15px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Subtotal:</span>
                            <strong>₹{{ number_format($subtotal, 2) }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Tax (18%):</span>
                            <strong>₹{{ number_format($tax, 2) }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Shipping:</span>
                            <strong>₹{{ number_format($shipping, 2) }}</strong>
                        </div>
                    </div>

                    <div style="border-top: 2px solid #ddd; padding-top: 15px;">
                        <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
                            <span>Total:</span>
                            <span style="color: #ff0000;">₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="card" style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h3 style="margin-bottom: 15px;">Payment Method</h3>
                    <select name="payment_method" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Select Payment Method</option>
                        <option value="credit_card">Credit/Debit Card</option>
                        <option value="upi">UPI</option>
                        <option value="net_banking">Net Banking</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 15px; font-size: 16px; font-weight: 600;">Complete Order</button>
                <a href="{{ route('cart.view') }}" style="display: block; text-align: center; margin-top: 10px; color: #666; text-decoration: none;">← Back to Cart</a>
            </div>
        </div>
    </form>
</div>


<script>
    // Auto-fill shipping address from billing address on load
    window.addEventListener('load', function() {
        const billingAddress = document.querySelector('textarea[name="billing_address"]');
        const shippingAddress = document.querySelector('textarea[name="shipping_address"]');
        if (billingAddress.value && !shippingAddress.value) {
            shippingAddress.value = billingAddress.value;
        }
    });

    document.querySelector('textarea[name="billing_address"]').addEventListener('change', function() {
        document.querySelector('textarea[name="shipping_address"]').value = this.value;
    });
</script>
@endsection
