<x-app-layout>
    <div class="flex min-h-screen">

        {{-- @include('layouts.sidebar') --}}

        <div class="flex-1 p-8 bg-gray-100">

            <h1 class="text-3xl font-bold mb-6">
                Permission Matrix
            </h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST">
                @csrf

                @foreach ($permissions as $module => $modulePermissions)
                    <div class="bg-white rounded shadow mb-8 overflow-x-auto">

                        <div class="p-4 font-bold text-lg border-b capitalize">
                            {{ $module }}
                        </div>

                        <table class="w-full">

                            <tr class="bg-gray-100">

                                <th class="p-3 text-left">Role</th>

                                @foreach ($modulePermissions as $permission)
                                    <th class="p-3 text-center">
                                        {{ ucfirst(explode('.', $permission->name)[1]) }}
                                    </th>
                                @endforeach

                            </tr>

                            @foreach ($roles as $role)
                                <tr class="border-t">

                                    <td class="p-3 font-medium">
                                        {{ $role->name }}
                                    </td>

                                    @foreach ($modulePermissions as $permission)
                                        <td class="p-3 text-center">

                                            <input type="checkbox" name="permissions[{{ $role->id }}][]"
                                                value="{{ $permission->name }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                        </table>

                    </div>
                @endforeach

                <button class="bg-blue-600 text-white px-6 py-3 rounded">
                    Save All Changes
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
