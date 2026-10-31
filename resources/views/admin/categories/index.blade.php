@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="page-title">Category Management</h1>
            <p class="page-subtitle">Manage product categories</p>
        </div>
        <button class="btn btn-primary" onclick="window.location.href='{{ url('/admin/categories/create') }}'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add Category
        </button>
    </div>

    @if (session('status'))
        <div class="flash-message flash-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="font-medium">{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if ($category->is_active)
                                    <span class="text-green-600 font-medium">Active</span>
                                @else
                                    <span class="text-red-600 font-medium">Inactive</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ url('/admin/categories/' . $category->id . '/edit') }}" class="text-blue-60 hover:text-blue-80">Edit</a>
                                <form action="{{ url('/admin/categories/' . $category->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-60 hover:text-red-80 delete-btn" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection