<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ setting('app_name', 'Tasbeeh') }}</title>

    <link rel="icon" href="{{ setting('favicon') ? asset('storage/' . setting('favicon')) : asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- <body class="min-h-screen flex"> --}}

<body class="min-h-screen flex opacity-0 transition-opacity duration-700" id="page">

    <!-- LEFT SIDE -->
    <div class="hidden md:flex w-1/2 bg-indigo-600 text-white flex-col justify-center items-center p-10">

        <div class="text-center">

            <a href="/">
                @if (setting('sidebar_logo'))
                    <img src="{{ asset('storage/' . setting('sidebar_logo')) }}"
                        class="w-20 h-20 mx-auto mb-6 bg-white p-2 rounded-xl">
                @endif
            </a>
            <h1 class="text-4xl font-bold mb-3">
                {{ setting('app_name', 'Tasbeeh') }}
            </h1>

            <p class="text-indigo-200">
                Admin Panel Management System
            </p>
            </a>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100">

        {{-- <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md"> --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md transform translate-y-10 opacity-0 transition duration-700"
            id="loginCard">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Admin Login
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Email</label>
                    <input type="email" name="email"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between mb-4 text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                <!-- Button -->
                <button id="loginBtn"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-xl font-medium flex items-center justify-center gap-2">
                    <span id="btnText">Login</span>
                    <span id="loader" class="hidden animate-spin">⏳</span>
                </button>

            </form>

        </div>

    </div>


    <script>
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('btnText').innerText = 'Logging in...';
            document.getElementById('loader').classList.remove('hidden');
            document.getElementById('loginBtn').disabled = true;

        });
    </script>

    <script>
        window.addEventListener('load', () => {
            document.getElementById('page').classList.remove('opacity-0');
        });
    </script>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                let card = document.getElementById('loginCard');
                card.classList.remove('translate-y-10', 'opacity-0');
            }, 200);
        });
    </script>
</body>

</html>
