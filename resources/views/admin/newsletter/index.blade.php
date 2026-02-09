@extends('admin.layouts.base')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Newsletter Subscribers ({{ $subscribers->count() }})</h2>
        <a href="{{ route('admin.newsletter.export') }}" class="btn">📥 Export to CSV</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Subscribed At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->id }}</td>
                    <td><strong>{{ $subscriber->email }}</strong></td>
                    <td>
                        @if($subscriber->is_active)
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Active</span>
                        @else
                            <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Unsubscribed</span>
                        @endif
                    </td>
                    <td>{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST" style="display: inline;" onsubmit="return confirm('Remove this subscriber?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
