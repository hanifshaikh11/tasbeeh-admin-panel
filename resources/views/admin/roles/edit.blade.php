<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <h1 class="text-2xl font-bold mb-6">
            Manage Permissions - {{ $role->name }}
        </h1>

        <form method="POST" action="{{ route('roles.permissions.update', $role->id) }}">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                @foreach ($permissions as $group => $items)
                    <div class="border rounded-2xl p-5">

                        <div class="flex justify-between items-center mb-4">

                            <h2 class="font-bold text-lg capitalize">
                                {{ $group }}
                            </h2>

                            <label class="text-sm flex items-center gap-2">
                                <input type="checkbox" class="group-toggle">
                                Select All
                            </label>

                        </div>

                        <div class="space-y-3">

                            @foreach ($items as $permission)
                                <label class="flex items-center gap-3">

                                    {{-- <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}> --}}

                                    <input type="checkbox" class="perm-checkbox" data-group="{{ $group }}"
                                        name="permissions[]" value="{{ $permission->name }}"
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>

                                    <span>
                                        @php
                                            $parts = explode('.', $permission->name);
                                            $module = ucfirst($parts[0]);
                                            $action = ucfirst($parts[1]);
                                        @endphp
                                        {{ $action }} {{ $module }}
                                    </span>

                                </label>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>

            <button class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-xl">
                Update Permissions
            </button>

        </form>

    </div>

</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.border');
        cards.forEach(card => {

            const parent = card.querySelector('.group-toggle');
            const children = card.querySelectorAll('.perm-checkbox');

            // Parent click = toggle all children
            parent.addEventListener('change', function() {
                children.forEach(cb => cb.checked = parent.checked);
            });

            // Child click = auto update parent
            children.forEach(cb => {
                cb.addEventListener('change', function() {

                    let total = children.length;
                    let checked = card.querySelectorAll('.perm-checkbox:checked')
                    .length;

                    parent.checked = (total === checked);

                });
            });

            // On page load auto check parent
            let total = children.length;
            let checked = card.querySelectorAll('.perm-checkbox:checked').length;
            parent.checked = (total === checked);
        });
    });
</script>
