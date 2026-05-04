<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Waitlist Users</h1>
                <p class="text-sm text-gray-500">
                    People who signed up for early access
                </p>
            </div>

            <!-- Search (optional) -->
            <form method="GET">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search email..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-indigo-500">
            </form>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Joined At</th>
                        <th class="p-3 text-left">Status</th>
                        @can('waitlist.delete')
                            <th class="p-3 text-left">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>

                    @forelse($waitlists as $item)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-3">{{ $item->id }}</td>

                            <td class="p-3 font-medium">
                                {{ $item->email }}
                            </td>

                            <td class="p-3">
                                {{ $item->created_at->format('d M Y, h:i A') }}
                            </td>

                            <td class="p-3">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                    Subscribed
                                </span>
                            </td>

                            @can('waitlist.delete')
                                <td class="p-3">
                                    <form method="POST" action="{{ route('waitlist.destroy', $item->id) }}"
                                        onsubmit="return confirm('Delete this email?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            @endcan

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                No waitlist users yet.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $waitlists->links() }}
        </div>

    </div>

</x-app-layout>
