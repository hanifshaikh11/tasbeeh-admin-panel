<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Welcome, {{ auth()->user()->name }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Role: {{ formatRoleName(auth()->user()->getRoleNames()->first()) }}
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Users -->
            <div class="bg-gray-50 border rounded-2xl p-6 hover:shadow transition">
                <h3 class="text-gray-600 text-sm">Total Users</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $totalUsers }}
                </p>
            </div>

            <!-- Total Admins -->
            <div class="bg-gray-50 border rounded-2xl p-6 hover:shadow transition">
                <h3 class="text-gray-600 text-sm">Total Admins</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $totalAdmins }}
                </p>
            </div>

            <!-- Premium Users -->
            <div class="bg-gray-50 border rounded-2xl p-6 hover:shadow transition">
                <h3 class="text-gray-600 text-sm">Premium Users</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    0
                </p>
            </div>

            <!-- Active Users -->
            <div class="bg-gray-50 border rounded-2xl p-6 hover:shadow transition">
                <h3 class="text-gray-600 text-sm">Active Users</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $activeUsers }}
                </p>
            </div>

            <!-- Blocked Users -->
            <div class="bg-gray-50 border rounded-2xl p-6 hover:shadow transition">
                <h3 class="text-gray-600 text-sm">Blocked Users</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">
                    {{ $blockedUsers }}
                </p>
            </div>

        </div>

    </div>

</x-app-layout>
