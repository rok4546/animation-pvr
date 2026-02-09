@extends('admin.layouts.base')

@section('title', 'Create Coupon')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 20px;">Create New Coupon</h2>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="code">Coupon Code *</label>
            <div style="display: flex; gap: 10px;">
                <input type="text" name="code" id="code" value="{{ old('code') }}" required style="flex: 1; text-transform: uppercase;">
                <button type="button" class="btn btn-secondary" onclick="generateCode()">Generate Code</button>
            </div>
            <small style="color: #666; display: block; margin-top: 5px;">Use uppercase letters and numbers only</small>
        </div>

        <div class="form-group">
            <label for="type">Discount Type *</label>
            <select name="type" id="type" required onchange="updateValueLabel()">
                <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
            </select>
        </div>

        <div class="form-group">
            <label for="value"><span id="value-label">Discount Value</span> *</label>
            <input type="number" name="value" id="value" value="{{ old('value') }}" step="0.01" min="0" required>
            <small style="color: #666; display: block; margin-top: 5px;" id="value-hint">Enter percentage (e.g., 10 for 10% off)</small>
        </div>

        <div class="form-group">
            <label for="min_order_amount">Minimum Order Amount</label>
            <input type="number" name="min_order_amount" id="min_order_amount" value="{{ old('min_order_amount') }}" step="0.01" min="0">
            <small style="color: #666; display: block; margin-top: 5px;">Minimum cart value required to use this coupon</small>
        </div>

        <div class="form-group">
            <label for="max_discount">Maximum Discount (for percentage coupons)</label>
            <input type="number" name="max_discount" id="max_discount" value="{{ old('max_discount') }}" step="0.01" min="0">
            <small style="color: #666; display: block; margin-top: 5px;">Cap the maximum discount amount</small>
        </div>

        <div class="form-group">
            <label for="usage_limit">Usage Limit</label>
            <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit') }}" min="1">
            <small style="color: #666; display: block; margin-top: 5px;">How many times this coupon can be used (leave empty for unlimited)</small>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="starts_at">Start Date</label>
                <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at') }}">
            </div>

            <div class="form-group">
                <label for="expires_at">Expiry Date</label>
                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}">
            </div>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Create Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
function generateCode() {
    fetch('{{ route("admin.coupons.generate-code") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('code').value = data.code;
    });
}

function updateValueLabel() {
    const type = document.getElementById('type').value;
    const label = document.getElementById('value-label');
    const hint = document.getElementById('value-hint');
    
    if (type === 'percentage') {
        label.textContent = 'Discount Percentage';
        hint.textContent = 'Enter percentage (e.g., 10 for 10% off)';
    } else {
        label.textContent = 'Discount Amount';
        hint.textContent = 'Enter fixed amount (e.g., 100 for ₹100 off)';
    }
}
</script>
@endsection
