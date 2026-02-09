@extends('admin.layouts.base')

@section('title', 'Coupons')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Discount Coupons</h2>
        <a href="{{ route('admin.coupons.create') }}" class="btn">+ Add New Coupon</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Min Order</th>
                    <th>Usage</th>
                    <th>Valid Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td><strong style="font-family: monospace; background: #f0f0f0; padding: 4px 8px; border-radius: 4px;">{{ $coupon->code }}</strong></td>
                    <td>
                        @if($coupon->type === 'percentage')
                            <span style="background: #667eea; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Percentage</span>
                        @else
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Fixed</span>
                        @endif
                    </td>
                    <td>
                        @if($coupon->type === 'percentage')
                            {{ $coupon->value }}%
                        @else
                            ₹{{ number_format($coupon->value, 2) }}
                        @endif
                    </td>
                    <td>{{ $coupon->min_order_amount ? '₹' . number_format($coupon->min_order_amount, 2) : '-' }}</td>
                    <td>
                        <span style="color: #666;">{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</span>
                    </td>
                    <td style="font-size: 12px;">
                        @if($coupon->starts_at)
                            {{ $coupon->starts_at->format('M d, Y') }}
                        @else
                            -
                        @endif
                        <br>to<br>
                        @if($coupon->expires_at)
                            {{ $coupon->expires_at->format('M d, Y') }}
                        @else
                            No Expiry
                        @endif
                    </td>
                    <td>
                        @if($coupon->isValid())
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Valid</span>
                        @else
                            <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Expired</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
