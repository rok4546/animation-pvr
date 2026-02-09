@extends('admin.layouts.base')

@section('title', 'Pages')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h2>Pages</h2>
    <a href="{{ route('admin.pages.create') }}" class="btn">+ Add New Page</a>
</div>

<div class="card">
    @if ($pages->count())
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td><code>{{ $page->slug }}</code></td>
                        <td>
                            @if ($page->is_active)
                                <span style="color: #4caf50;">Active</span>
                            @else
                                <span style="color: #999;">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $page->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" style="display: inline; margin-left: 5px;" onsubmit="return confirm('Are you sure?');">
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
            {{ $pages->links() }}
        </div>
    @else
        <p style="color: #999; text-align: center; padding: 40px;">No pages found</p>
    @endif
</div>
@endsection
