<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Users</h1>
                <p class="text-sm text-gray-500">
                    Manage all registered users
                </p>
            </div>

            <!-- Search -->
            <form method="GET">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search user..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-indigo-500">
            </form>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Status</th>

                        @can('users.manage')
                            <th class="p-3 text-left">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-3">{{ $user->id }}</td>

                            <td class="p-3 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="p-3">
                                {{ $user->email }}
                            </td>

                            <td class="p-3">
                                {{ $user->getRoleNames()->first() }}
                            </td>

                            <td class="p-3">
                                <span class="status-badge">
                                    @if ($user->status)
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                            Active
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                            Blocked
                                        </span>
                                    @endif
                                </span>
                            </td>

                            @can('users.manage')
                                <td class="p-3">
                                    @if ($user->hasRole('super_admin'))
                                        <span class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-full">
                                            Protected
                                        </span>
                                    @else
                                        <form class="status-form" action="{{ route('users.toggle.status', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="status-btn text-white px-4 py-2 rounded-lg text-xs {{ $user->status ? 'bg-red-600' : 'bg-green-600' }}">
                                                {{ $user->status ? 'Block' : 'Unblock' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endcan

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

</x-app-layout>
