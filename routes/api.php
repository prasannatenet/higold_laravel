<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

// These same-origin endpoints use the admin session and remain protected by CSRF.
// Public endpoint for the website customer form. The admin list remains private.
Route::post('/v1/customer-details', function (Request $request) {
    $validated = $request->validate([
        'customer_type' => ['required', Rule::in(Customer::TYPES)],
        'name' => ['required', 'string', 'max:255'],
        'mobile' => ['required', 'string', 'max:30'],
        'city' => ['required', 'string', 'max:120'],
        'pincode' => ['required', 'string', 'max:12'],
        'email' => ['nullable', 'email', 'max:255', 'unique:customers,email'],
        'interests' => ['required', 'array', 'min:1'],
        'interests.*' => ['required', 'string', Rule::in(Customer::INTERESTS)],
    ]);

    $customer = Customer::create($validated + ['contact_number' => $validated['mobile']]);

    return response()->json([
        'message' => 'Customer details submitted successfully.',
        'data' => $customer->only([
            'id', 'customer_type', 'name', 'mobile', 'city', 'pincode', 'email', 'interests', 'created_at',
        ]),
    ], 201);
})->middleware('throttle:10,1');

Route::middleware(['web', 'auth', 'can:admin'])->group(function () {
    Route::get('/user-details', fn () => Customer::query()->latest()->get());

    Route::post('/user-details', function (Request $request) {
        $validated = $request->validate([
            'customer_type' => ['required', Rule::in(Customer::TYPES)],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:120'],
            'pincode' => ['required', 'string', 'max:12'],
            'email' => ['nullable', 'email', 'max:255', 'unique:customers,email'],
            'interests' => ['required', 'array', 'min:1'],
            'interests.*' => ['required', 'string', Rule::in(Customer::INTERESTS)],
        ]);

        return response()->json(Customer::create($validated + ['contact_number' => $validated['mobile']]), 201);
    });
});
