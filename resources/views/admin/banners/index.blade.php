@extends('admin.layouts.base')

@section('title', 'Banners')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Homepage Banners</h2>
        <a href="{{ route('admin.banners.create') }}" class="btn">+ Add New Banner</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Button Text</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>
                        @if($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="width: 100px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 100px; height: 50px; background: #ddd; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Image</div>
                        @endif
                    </td>
                    <td><strong>{{ $banner->title }}</strong></td>
                    <td>
                        @if($banner->link)
                            <a href="{{ $banner->link }}" target="_blank" style="color: #667eea; text-decoration: none;">{{ Str::limit($banner->link, 30) }}</a>
                        @else
                            <span style="color: #999;">No link</span>
                        @endif
                    </td>
                    <td>{{ $banner->button_text ?? '-' }}</td>
                    <td>{{ $banner->sort_order }}</td>
                    <td>
                        @if($banner->is_active)
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Active</span>
                        @else
                            <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
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
