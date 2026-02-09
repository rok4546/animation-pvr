@extends('admin.layouts.base')

@section('title', 'Payment Settings')

@section('content')
<div class="card">
    <h2 style="margin: 0 0 20px 0;">💳 Payment Settings</h2>

    <form method="POST" action="{{ route('admin.settings.payment.update') }}">
        @csrf

        <!-- Cash on Delivery -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">💵 Cash on Delivery (COD)</h3>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="cod_enabled" value="1" {{ ($settings['cod_enabled'] ?? true) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                    <span>Enable Cash on Delivery</span>
                </label>
                <small style="color: #666; display: block; margin-top: 5px;">Allow customers to pay when they receive the order</small>
            </div>
        </div>

        <!-- Razorpay -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">💎 Razorpay</h3>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="razorpay_enabled" value="1" {{ ($settings['razorpay_enabled'] ?? false) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                    <span>Enable Razorpay</span>
                </label>
                <small style="color: #666; display: block; margin-top: 5px;">Accept online payments via Razorpay</small>
            </div>

            <div class="form-group">
                <label for="razorpay_key">Razorpay Key ID</label>
                <input type="text" id="razorpay_key" name="razorpay_key" value="{{ old('razorpay_key', $settings['razorpay_key'] ?? '') }}" placeholder="rzp_test_xxxxxxxxxxxxx">
            </div>

            <div class="form-group">
                <label for="razorpay_secret">Razorpay Key Secret</label>
                <input type="password" id="razorpay_secret" name="razorpay_secret" value="{{ old('razorpay_secret', $settings['razorpay_secret'] ?? '') }}" placeholder="••••••••••••••••">
                <small style="color: #666; display: block; margin-top: 5px;">Your Razorpay secret key (kept secure)</small>
            </div>
        </div>

        <!-- Stripe -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 15px 0; font-size: 18px;">💳 Stripe</h3>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="stripe_enabled" value="1" {{ ($settings['stripe_enabled'] ?? false) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                    <span>Enable Stripe</span>
                </label>
                <small style="color: #666; display: block; margin-top: 5px;">Accept online payments via Stripe</small>
            </div>

            <div class="form-group">
                <label for="stripe_key">Stripe Publishable Key</label>
                <input type="text" id="stripe_key" name="stripe_key" value="{{ old('stripe_key', $settings['stripe_key'] ?? '') }}" placeholder="pk_test_xxxxxxxxxxxxx">
            </div>

            <div class="form-group">
                <label for="stripe_secret">Stripe Secret Key</label>
                <input type="password" id="stripe_secret" name="stripe_secret" value="{{ old('stripe_secret', $settings['stripe_secret'] ?? '') }}" placeholder="sk_test_xxxxxxxxxxxxx">
                <small style="color: #666; display: block; margin-top: 5px;">Your Stripe secret key (kept secure)</small>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>
@endsection
