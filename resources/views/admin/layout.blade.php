<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ $title ?? 'Admin' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #f8fafc; --fg: #1e293b; --muted: #64748b; --accent: #3b82f6; --accent-hover: #2563eb; --card: #ffffff; --border: #e2e8f0; --danger: #ef4444; --success: #10b981; }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg); color: var(--fg); min-height: 100vh; }
        .sidebar { background-color: var(--card); min-height: 100vh; border-right: 1px solid var(--border); }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; color: var(--muted); text-decoration: none; border-radius: 0.5rem; margin: 0.25rem 1rem; transition: all 0.2s ease; }
        .sidebar-link:hover { background-color: var(--bg); color: var(--fg); }
        .sidebar-link.active { background-color: var(--accent); color: white; }
        .sidebar-link.active:hover { background-color: var(--accent-hover); }
        .main-content { padding: 1.5rem; }
        .page-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; }
        .page-subtitle { color: var(--muted); margin-bottom: 1.5rem; }
        .card { background-color: var(--card); border: 1px solid var(--border); border-radius: 0.75rem; padding: 1.5rem; }
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s ease; border: none; white-space: nowrap; }
        .btn-primary { background-color: var(--accent); color: white; }
        .btn-primary:hover { background-color: var(--accent-hover); }
        .btn-secondary { background-color: var(--bg); color: var(--fg); }
        .btn-secondary:hover { background-color: var(--fg); color: var(--bg); }
        .btn-danger { background-color: var(--danger); color: white; }
        .btn-danger:hover { background-color: var(--fg); }
        .btn-success { background-color: var(--success); color: white; }
        .btn-success:hover { background-color: var(--fg); }
        .input-field { width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; font-size: 1rem; transition: border-color 0.2s; }
        .input-field:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .table th, .table td { padding: 0.75rem; }
        .table th { background-color: var(--bg); color: var(--muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .table tr { border-bottom: 1px solid var(--border); }
        .table tr:hover { background-color: var(--bg); }
        .flash-message { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
        .flash-success { background-color: #d1fdca; color: #065f46; }
        .flash-error { background-color: #fee2e2; color: #991b1b; }
        .flash-info { background-color: #bfdbfe; color: #1e40af; }
    </style>
</head>
<body class="min-h-screen">
<div class="flex min-h-screen">
    <aside class="sidebar flex w-64 flex-col">
        <div class="p-4 border-b border-border"><a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Panel</a></div>
        <nav class="flex flex-col space-y-1 pt-2">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">User Details</a>
        </nav>
        <div class="mt-auto border-t border-border p-4">
            <p class="mb-3 truncate text-sm text-slate-600">Signed in as {{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full cursor-pointer border-0 bg-transparent text-left">
                    Log out
                </button>
            </form>
        </div>
    </aside>
    <main class="flex-1 main-content">@yield('content')</main>
</div>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    const customerForm = document.querySelector('form[action*="/admin/customers"]');
    if (customerForm) {
        customerForm.addEventListener('submit', async event => {
            event.preventDefault();
            let errorBox = document.getElementById('api-errors');
            if (!errorBox) {
                errorBox = document.createElement('p');
                errorBox.id = 'api-errors';
                errorBox.className = 'mb-4 text-sm text-red-600';
                errorBox.setAttribute('role', 'alert');
                customerForm.prepend(errorBox);
            }
            errorBox.textContent = '';
            try {
                const formData = new FormData(customerForm);
                const payload = Object.fromEntries(formData.entries());
                payload.interests = formData.getAll('interests[]');
                delete payload['interests[]'];
                const response = await fetch('/api/user-details', {
                    method: 'POST', credentials: 'same-origin',
                    headers: { Accept: 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();
                if (!response.ok) {
                    errorBox.textContent = result.errors ? Object.values(result.errors).flat().join(' ') : (result.message || 'Could not save user details.');
                    return;
                }
                window.location.href = '{{ route('admin.customers.index') }}?saved=1';
            } catch {
                errorBox.textContent = 'Could not connect to the server. Please try again.';
            }
        });
    }

    const customerTableBody = document.querySelector('[data-user-details] tbody');
    if (customerTableBody) {
        fetch('/api/user-details', { headers: { Accept: 'application/json' }, credentials: 'same-origin' })
            .then(response => response.ok ? response.json() : Promise.reject())
            .then(customers => {
                customerTableBody.replaceChildren();
                if (!customers.length) {
                    const row = customerTableBody.insertRow();
                    const cell = row.insertCell();
                    cell.colSpan = 7;
                    cell.className = 'py-8 text-center text-slate-500';
                    cell.textContent = 'No user details have been saved yet.';
                    return;
                }
                customers.forEach(customer => {
                    const row = customerTableBody.insertRow();
                    [customer.customer_type, customer.name, customer.mobile || customer.contact_number, customer.city, customer.pincode, customer.email, (customer.interests || []).join(', ')]
                        .forEach(value => row.insertCell().textContent = value ?? '—');
                });
            }).catch(() => {});
    }
</script>
@stack('scripts')
</body>
</html>
