@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="page-title">User Management</h1>
            <p class="page-subtitle">Manage all users in the system</p>
        </div>
        <button class="btn btn-primary" onclick="window.location.href='{{ url('/admin/users/create') }}'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add User
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
                        <th>Email</th>
                        <th>Created At</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="font-medium">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-right">
                                <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" class="text-blue-60 hover:text-blue-80">Edit</a>
                                <form action="{{ url('/admin/users/' . $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-60 hover:text-red-80 delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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