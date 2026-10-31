@extends('admin.layout')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <div class="card-header">
            <h2 class="font-semibold">Edit Product</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="mb-4 p-3 border-l-4 border-red-500 bg-red-100 text-red-800 rounded alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/admin/products/' . $product->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Name</label>
                    <input type="text" name="name" class="input-field" value="{{ $product->name }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Slug</label>
                    <input type="text" name="slug" class="input-field" value="{{ $product->slug }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select name="category_id" class="input-field">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Price</label>
                    <input type="number" step="0.01" name="price" class="input-field" value="{{ $product->price }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Stock</label>
                    <input type="number" name="stock" class="input-field" value="{{ $product->stock }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" class="input-field" rows="3">{{ $product->description }}</textarea>
                </div>
                
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary w-full">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Update Product
                    </button>
                    <a href="{{ url('/admin/products') }}" class="btn btn-secondary w-full mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection