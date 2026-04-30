<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('app_name', 'Tasbeeh') }}</title>

    <link rel="icon" href="{{ setting('favicon') ? asset('storage/' . setting('favicon')) : asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main -->
        <div class="flex-1 flex flex-col min-h-screen">

            <!-- Top Navbar -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ setting('page_title', 'Dashboard') }}
                    </h1>

                    <p class="text-sm text-gray-500">
                        Welcome back, {{ auth()->user()->name }}
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <!-- Notification -->
                    <button class="relative p-2 rounded-lg hover:bg-gray-100">
                        🔔
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                            3
                        </span>
                    </button>

                    <!-- Profile -->
                    <div class="relative group">

                        <button class="bg-gray-100 px-4 py-2 rounded-xl hover:bg-gray-200">
                            {{ auth()->user()->name }} ▼
                        </button>

                        <div
                            class="hidden group-hover:block absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg z-50">

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-3 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </header>

            <!-- Content -->
            <main class="p-6 flex-1">
                {{ $slot }}
            </main>

        </div>

    </div>


    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-form').forEach(form => {

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This record will be deleted permanently.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.status-form').forEach(form => {

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    let button = form.querySelector('.status-btn');
                    let row = form.closest('tr');
                    let badgeWrap = row.querySelector('.status-badge');

                    let response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    let data = await response.json();

                    if (data.success) {

                        if (data.status == 1) {

                            badgeWrap.innerHTML = `
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                            Active
                        </span>
                    `;

                            button.innerText = 'Block';
                            button.classList.remove('bg-green-600');
                            button.classList.add('bg-red-600');

                        } else {

                            badgeWrap.innerHTML = `
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                            Blocked
                        </span>
                    `;

                            button.innerText = 'Unblock';
                            button.classList.remove('bg-red-600');
                            button.classList.add('bg-green-600');
                        }

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2200
                        });

                    }

                });

            });

        });
    </script>

</body>

</html>
