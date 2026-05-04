<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ setting('app_name', 'Tasbeeh') }}</title>

    <link rel="icon" href="{{ setting('favicon') ? asset('storage/' . setting('favicon')) : asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-600 to-purple-700 text-white flex flex-col">

    <!-- Navbar -->
    <div class="flex justify-between items-center p-6">

        <h1 class="text-xl font-bold">
            {{ setting('app_name', 'Tasbeeh') }}
        </h1>

        <a href="{{ route('login') }}"
            class="bg-white text-indigo-600 px-5 py-2 rounded-xl font-medium hover:scale-105 transition">
            Login
        </a>

    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col justify-center items-center text-center px-6">

        <h2 class="text-4xl md:text-5xl font-bold mb-4">
            Digital Tasbeeh Experience
        </h2>

        <p class="text-indigo-200 max-w-xl mb-6">
            Track your daily zikr, build consistency, and grow spiritually with our smart Tasbeeh system.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('login') }}"
                class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold hover:scale-105 transition">
                Get Started
            </a>

            {{-- <button class="border border-white px-6 py-3 rounded-xl hover:bg-white hover:text-indigo-600 transition">
                Coming Soon 🚀
            </button> --}}
        </div>
        <div class="mt-10 bg-white/10 backdrop-blur-md p-6 rounded-2xl max-w-md w-full">

            @if (session('success'))
                <p class="text-green-300 text-center mb-3">
                    {{ session('success') }}
                </p>
            @endif

            @error('email')
                <p class="text-green-500 text-center mb-3">{{ $message }}</p>
            @enderror

            <form method="POST" action="{{ route('waitlist.store') }}" class="flex gap-2">
                @csrf

                <input type="email" name="email" placeholder="Enter your email"
                    class="flex-1 px-4 py-2 rounded-xl text-black focus:outline-none" required>


                <button type="submit"
                    class="bg-white text-indigo-600 px-4 py-2 rounded-xl font-semibold hover:scale-105 transition">
                    Join
                </button>
            </form>

            <p class="text-xs text-indigo-200 mt-2 text-center">
                Get notified when app launches 🚀
            </p>

        </div>

    </div>


    <!-- Footer -->
    <div class="text-center text-sm text-indigo-200 p-4">
        © {{ date('Y') }} {{ setting('app_name', 'Tasbeeh') }}. All rights reserved.
    </div>

</body>

</html>
