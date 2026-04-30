<x-app-layout>

<div class="bg-white rounded-2xl shadow p-6 max-w-4xl">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Create Admin
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Add a new admin account with secure login access.
        </p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admins.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter full name"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter email"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>

                <input type="password"
                       name="password"
                       placeholder="Enter password"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-8 flex gap-3">

            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition">
                Create Admin
            </button>

            <a href="{{ route('admins.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl transition">
                Cancel
            </a>

        </div>

    </form>

</div>

</x-app-layout>