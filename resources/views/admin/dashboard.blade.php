@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <div class="card-header">
            <h2 class="font-semibold">Dashboard</h2>
        </div>
        <div class="card-body">
            <p class="text-lg text-muted mb-6">Welcome to the Admin Panel</p>
            
            <div>
                <h3 class="font-medium mb-3">Quick Stats</h3>
                <ul class="space-y-2 text-sm text-muted">
                    <li>Use the sidebar to manage user contact details</li>
                    <li>Click "Add" to create new entries</li>
                    <li>Use the Edit and Delete actions on each resource</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Dashboard-specific scripts can go here
</script>
@endpush
