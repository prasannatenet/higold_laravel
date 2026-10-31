@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="page-title">Product Management</h1>
            <p class="page-subtitle">Manage all products</p>
        </div>
        <button class="btn btn-primary" onclick="window.location.href='{{ url('/admin/products/create') }}'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add Product
        </button>
    </div>

    @if (session('status'))
        <div class="flash-message flash-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="overflow-x-auto">
            <table class="table w-full" data-products>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="font-medium">{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name ?? 'N/A' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-right">
                                <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="text-blue-60 hover:text-blue-80">Edit</a>
                                <form action="{{ url('/admin/products/' . $product->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-60 hover:text-red-80 delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
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
