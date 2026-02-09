@extends('admin.layouts.base')

@section('title', 'Categories')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h2>Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn">+ Add New Category</a>
</div>

<div class="card">
    @if ($categories->count())
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            @if ($category->is_active)
                                <span style="color: #4caf50;">Active</span>
                            @else
                                <span style="color: #999;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline; margin-left: 5px;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $categories->links() }}
        </div>
    @else
        <p style="color: #999; text-align: center; padding: 40px;">No categories found</p>
    @endif
</div>
@endsection
