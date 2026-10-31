@extends('admin.layout')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="mb-4 flex items-center justify-between gap-4">
        <div>
            <h1 class="page-title">User Details</h1>
            <p class="page-subtitle">Saved names and contact information.</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Add user details</a>
    </div>

    @if (session('status'))
        <div class="flash-message flash-success">{{ session('status') }}</div>
    @endif

    @if (request()->boolean('saved'))
        <div class="flash-message flash-success">User details saved successfully.</div>
    @endif

    <div class="card overflow-x-auto" data-user-details>
        <table class="table w-full text-left">
            <thead>
                <tr>
                    <th>Customer type</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>Pincode</th>
                    <th>Email</th>
                    <th>Interested in</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_type }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->mobile ?: $customer->contact_number }}</td>
                        <td>{{ $customer->city ?? '—' }}</td>
                        <td>{{ $customer->pincode }}</td>
                        <td>{{ $customer->email ?? '—' }}</td>
                        <td>{{ implode(', ', $customer->interests ?? []) ?: '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-500">No user details have been saved yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
