@extends('admin.layout')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <div class="card-header">
            <h2 class="font-semibold">Add New User</h2>
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

            <form action="{{ url('/admin/users') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Name</label>
                    <input type="text" name="name" class="input-field" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" class="input-field" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" class="input-field" required>
                </div>
                
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary w-full">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection