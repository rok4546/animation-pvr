@extends('layouts.app')

@section('title', 'Shopping Cart - ANIME ARTISTRY')

@section('content')
<div class="container">
    <h1 style="margin: 40px 0;">Shopping Cart</h1>

    @if ($items)
        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 30px;">
            <div class="card" style="background: white; padding: 20px; border-radius: 8px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #ddd;">
                            <th style="text-align: left; padding: 15px; font-weight: 600;">Product</th>
                            <th style="text-align: center; padding: 15px; font-weight: 600;">Price</th>
                            <th style="text-align: center; padding: 15px; font-weight: 600;">Quantity</th>
                            <th style="text-align: right; padding: 15px; font-weight: 600;">Total</th>
                            <th style="text-align: center; padding: 15px; font-weight: 600;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr style="border-bottom: 1px solid #ddd;">
                                <td style="padding: 15px;">
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        @if ($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div style="width: 80px; height: 80px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <span style="color: #999; font-size: 12px;">No Image</span>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ $item['product']->name }}</strong><br>
                                            <span style="color: #999; font-size: 13px;">SKU: {{ $item['product']->sku }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center; padding: 15px;">
                                    ₹{{ number_format($item['product']->price, 0) }}
                                </td>
                                <td style="text-align: center; padding: 15px;">
                                    <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" style="display: inline;">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" style="width: 70px; padding: 6px; border: 1px solid #ddd; border-radius: 4px; text-align: center;">
                                        <button type="submit" style="margin-left: 5px; padding: 6px 12px; background: #f0f0f0; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">Update</button>
                                    </form>
                                </td>
                                <td style="text-align: right; padding: 15px; font-weight: 600;">
                                    ₹{{ number_format($item['subtotal'], 0) }}
                                </td>
                                <td style="text-align: center; padding: 15px;">
                                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}" style="display: inline;" onsubmit="return confirm('Remove from cart?');">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: #f44336; cursor: pointer; font-size: 18px;">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card" style="background: white; padding: 20px; border-radius: 8px; height: fit-content;">
                <h2 style="font-size: 18px; margin-bottom: 20px; border-bottom: 2px solid #ddd; padding-bottom: 15px;">Order Summary</h2>
                
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal:</span>
                        <strong>₹{{ number_format($total, 2) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #999; font-size: 13px;">
                        <span>Tax (18%):</span>
                        <strong>₹{{ number_format($total * 0.18, 2) }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #999; font-size: 13px;">
                        <span>Shipping:</span>
                        <strong>₹0</strong>
                    </div>
                </div>

                <div style="border-top: 2px solid #ddd; padding-top: 15px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold;">
                        <span>Total:</span>
                        <span style="color: #ff0000;">₹{{ number_format($total * 1.18, 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('cart.checkout') }}" class="btn" style="width: 100%; text-align: center; padding: 12px;">Proceed to Checkout</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline" style="width: 100%; text-align: center; padding: 12px; margin-top: 10px; display: block;">Continue Shopping</a>
            </div>
        </div>
    @else
        <div style="background: white; padding: 60px 20px; border-radius: 8px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🛒</div>
            <h2 style="color: #999; margin-bottom: 15px;">Your cart is empty</h2>
            <p style="color: #999; margin-bottom: 30px;">Add some amazing anime products to your cart and come back here to checkout</p>
            <a href="{{ route('products.index') }}" class="btn" style="padding: 12px 40px;">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
