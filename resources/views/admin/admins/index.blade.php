<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Admins</h1>
                <p class="text-sm text-gray-500">
                    Manage all system admins
                </p>
            </div>

            <!-- Search (optional future backend hook) -->
            {{-- <form method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search admin..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-indigo-500">
            </form> --}}

            <!-- Create Button -->
            <a href="{{ route('admins.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm">
                + Create Admin
            </a>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($admins as $admin)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-3">{{ $admin->id }}</td>

                            <td class="p-3 font-medium">
                                {{ $admin->name }}
                            </td>

                            <td class="p-3">
                                {{ $admin->email }}
                            </td>

                            <td class="p-3 flex gap-2">

                                <a href="{{ route('admins.edit', $admin->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admins.destroy', $admin->id) }}"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                No admins found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination (agar add karni ho future me) -->
        {{-- <div class="mt-6">
            {{ $admins->links() }}
        </div> --}}

    </div>

</x-app-layout>
