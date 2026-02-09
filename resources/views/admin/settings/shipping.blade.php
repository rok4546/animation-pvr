@extends('admin.layouts.base')

@section('title', 'Shipping Settings')

@section('content')
<div class="card">
    <h2 style="margin: 0 0 20px 0;">🚚 Shipping Settings</h2>

    <form method="POST" action="{{ route('admin.settings.shipping.update') }}">
        @csrf

        <div class="form-group">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="shipping_enabled" value="1" {{ ($settings['shipping_enabled'] ?? true) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                <span>Enable Shipping</span>
            </label>
            <small style="color: #666; display: block; margin-top: 5px;">Allow customers to select shipping options during checkout</small>
        </div>

        <div class="form-group">
            <label for="free_shipping_threshold">Free Shipping Threshold (₹)</label>
            <input type="number" id="free_shipping_threshold" name="free_shipping_threshold" value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold'] ?? 500) }}" step="0.01" min="0">
            <small style="color: #666; display: block; margin-top: 5px;">Orders above this amount will get free shipping (set to 0 to disable)</small>
        </div>

        <div class="form-group">
            <label for="flat_rate_shipping">Flat Rate Shipping Cost (₹)</label>
            <input type="number" id="flat_rate_shipping" name="flat_rate_shipping" value="{{ old('flat_rate_shipping', $settings['flat_rate_shipping'] ?? 50) }}" step="0.01" min="0">
            <small style="color: #666; display: block; margin-top: 5px;">Standard shipping cost for all orders</small>
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="local_pickup_enabled" value="1" {{ ($settings['local_pickup_enabled'] ?? false) ? 'checked' : '' }} style="width: auto; margin-right: 10px;">
                <span>Enable Local Pickup</span>
            </label>
            <small style="color: #666; display: block; margin-top: 5px;">Allow customers to pick up orders from your location</small>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <h3 style="margin: 0 0 15px 0; font-size: 16px;">Shipping Zones (Coming Soon)</h3>
            <p style="color: #666; margin: 0;">Configure different shipping rates for different regions and countries.</p>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
