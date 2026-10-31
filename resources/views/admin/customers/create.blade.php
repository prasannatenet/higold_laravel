@extends('admin.layout')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-6">
        <h1 class="page-title">Add User Details</h1>
        <p class="page-subtitle">Save a user’s contact information.</p>
    </div>

    <form method="POST" action="{{ route('admin.customers.store') }}" class="card space-y-5">
        @csrf

        <div>
            <label for="customer_type" class="mb-1 block text-sm font-medium">Customer type</label>
            <select id="customer_type" name="customer_type" required class="input-field">
                <option value="">Select customer type</option>
                @foreach (\App\Models\Customer::TYPES as $type)
                    <option value="{{ $type }}" @selected(old('customer_type') === $type)>{{ $type }}</option>
                @endforeach
            </select>
            @error('customer_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="name" class="mb-1 block text-sm font-medium">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" required maxlength="255" class="input-field" autocomplete="name">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="mobile" class="mb-1 block text-sm font-medium">Mobile</label>
            <input id="mobile" name="mobile" type="tel" value="{{ old('mobile') }}" required maxlength="30" class="input-field" autocomplete="tel">
            @error('mobile') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="city" class="mb-1 block text-sm font-medium">City</label>
            <input id="city" name="city" value="{{ old('city') }}" required maxlength="120" class="input-field" autocomplete="address-level2">
            @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email <span class="font-normal text-slate-500">(optional)</span></label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="255" class="input-field" autocomplete="email">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="pincode" class="mb-1 block text-sm font-medium">Pincode</label>
            <input id="pincode" name="pincode" value="{{ old('pincode') }}" required maxlength="12" class="input-field" autocomplete="postal-code">
            @error('pincode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="interests" class="mb-1 block text-sm font-medium">Interested in</label>
            <select id="interests" name="interests[]" multiple required class="input-field min-h-36">
                @foreach (\App\Models\Customer::INTERESTS as $interest)
                    <option value="{{ $interest }}" @selected(in_array($interest, old('interests', []), true))>{{ $interest }}</option>
                @endforeach
            </select>
            <p class="mt-1 text-sm text-slate-500">Select one or more options. Use Ctrl or Command to select multiple.</p>
            @error('interests') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('interests.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn btn-primary">Save details</button>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
