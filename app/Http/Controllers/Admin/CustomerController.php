<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('admin.customers.index', [
            'customers' => Customer::query()->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.customers.create');
    }

    public function store(Request $request): RedirectResponse
    {
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

        Customer::create($validated + ['contact_number' => $validated['mobile']]);

        return redirect()->route('admin.customers.index')->with('status', 'User details saved successfully.');
    }
}
