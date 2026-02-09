@extends('admin.layouts.base')

@section('title', 'Edit Coupon')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 20px;">Edit Coupon</h2>

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Coupon Code *</label>
            <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}" required style="text-transform: uppercase;">
        </div>

        <div class="form-group">
            <label for="type">Discount Type *</label>
            <select name="type" id="type" required onchange="updateValueLabel()">
                <option value="percentage" {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}>Percentage</option>
                <option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
        </div>

        <div class="form-group">
            <label for="value"><span id="value-label">{{ $coupon->type === 'percentage' ? 'Discount Percentage' : 'Discount Amount' }}</span> *</label>
            <input type="number" name="value" id="value" value="{{ old('value', $coupon->value) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="min_order_amount">Minimum Order Amount</label>
            <input type="number" name="min_order_amount" id="min_order_amount" value="{{ old('min_order_amount', $coupon->min_order_amount) }}" step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="max_discount">Maximum Discount</label>
            <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}" step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="usage_limit">Usage Limit</label>
            <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1">
            <small style="color: #666; display: block; margin-top: 5px;">Used: {{ $coupon->used_count }} times</small>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="starts_at">Start Date</label>
                <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at', $coupon->starts_at?->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="form-group">
                <label for="expires_at">Expiry Date</label>
                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d\TH:i')) }}">
            </div>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Update Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
function updateValueLabel() {
    const type = document.getElementById('type').value;
    const label = document.getElementById('value-label');
    
    if (type === 'percentage') {
        label.textContent = 'Discount Percentage';
    } else {
        label.textContent = 'Discount Amount';
    }
}
</script>
@endsection
