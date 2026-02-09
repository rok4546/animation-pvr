@extends('admin.layouts.base')

@section('title', 'Anime Collections')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Anime Collections</h2>
        <a href="{{ route('admin.anime-collections.create') }}" class="btn">+ Add New Collection</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="datatable" style="width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collections as $collection)
                <tr>
                    <td>{{ $collection->id }}</td>
                    <td>
                        @if($collection->image)
                            <img src="{{ asset('storage/' . $collection->image) }}" alt="{{ $collection->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #ddd; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Image</div>
                        @endif
                    </td>
                    <td><strong>{{ $collection->name }}</strong></td>
                    <td><code>{{ $collection->slug }}</code></td>
                    <td>
                        <span style="background: #667eea; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                            {{ $collection->products_count }} products
                        </span>
                    </td>
                    <td>{{ $collection->sort_order }}</td>
                    <td>
                        @if($collection->is_active)
                            <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Active</span>
                        @else
                            <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.anime-collections.edit', $collection) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form action="{{ route('admin.anime-collections.destroy', $collection) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this collection?');">
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
