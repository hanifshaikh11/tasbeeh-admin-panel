{{-- <x-app-layout>
    <div class="flex min-h-screen">

        <div class="flex-1 p-8 bg-gray-100">
            <h1 class="text-3xl font-bold mb-6">Roles</h1>

            <table class="w-full bg-white rounded shadow">
                <tr class="bg-gray-100">
                    <th class="p-3">ID</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Action</th>
                </tr>

                @foreach ($roles as $role)
                    <tr class="border-b">
                        <td class="p-3">{{ $role->id }}</td>
                        <td class="p-3">{{ $role->name }}</td>
                        <td class="p-3">
                            <a href="{{ route('roles.permissions', $role->id) }}"
                                class="bg-blue-600 text-white px-3 py-1 rounded">
                                Manage Permissions
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Roles</h1>
                <p class="text-sm text-gray-500">
                    Manage system roles & permissions
                </p>
            </div>

            <!-- Optional Search -->
            <form method="GET">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search role..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-indigo-500">
            </form>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($roles as $role)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-3">{{ $role->id }}</td>

                            <td class="p-3 font-medium">
                                {{ $role->name }}
                            </td>

                            <td class="p-3">

                                <a href="{{ route('roles.permissions', $role->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs">
                                    Manage Permissions
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="p-6 text-center text-gray-500">
                                No roles found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination (future ready) -->
        {{-- <div class="mt-6">
            {{ $roles->links() }}
        </div> --}}

    </div>

</x-app-layout>