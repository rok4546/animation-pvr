@extends('admin.layouts.base')

@section('title', 'Testimonials')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Customer Testimonials</h2>
    </div>

    <div style="overflow-x: auto;">
        <table class="datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->id }}</td>
                    <td><strong>{{ $testimonial->customer_name }}</strong></td>
                    <td>
                        <div style="color: #ffc107;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                    </td>
                    <td style="max-width: 300px;">{{ Str::limit($testimonial->review_text, 100) }}</td>
                    <td>
                        @if($testimonial->product)
                            <a href="{{ route('admin.products.edit', $testimonial->product) }}" style="color: #667eea; text-decoration: none;">
                                {{ $testimonial->product->name }}
                            </a>
                        @else
                            <span style="color: #999;">General</span>
                        @endif
                    </td>
                    <td>{{ $testimonial->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            @if($testimonial->is_approved)
                                <span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 8px; font-size: 11px;">Approved</span>
                            @else
                                <span style="background: #ffc107; color: #000; padding: 2px 6px; border-radius: 8px; font-size: 11px;">Pending</span>
                            @endif
                            
                            @if($testimonial->is_featured)
                                <span style="background: #667eea; color: white; padding: 2px 6px; border-radius: 8px; font-size: 11px;">Featured</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn {{ $testimonial->is_approved ? 'btn-secondary' : 'btn' }}" style="padding: 4px 8px; font-size: 11px; width: 100%;">
                                    {{ $testimonial->is_approved ? 'Unapprove' : 'Approve' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.testimonials.feature', $testimonial) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary" style="padding: 4px 8px; font-size: 11px; width: 100%;">
                                    {{ $testimonial->is_featured ? 'Unfeature' : 'Feature' }}
                                </button>
                            </form>
                            
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-secondary" style="padding: 4px 8px; font-size: 11px; text-align: center;">Edit</a>
                            
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 11px; width: 100%;">Delete</button>
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
