<div x-data="{ open: true }" :class="open ? 'w-64' : 'w-20'"
    class="bg-gray-900 text-white min-h-screen p-4 transition-all duration-300">

    <!-- Top Brand + Toggle -->
    <div class="mb-8 border-b border-gray-700 pb-5">

        <div class="flex items-center justify-between">

            <!-- Logo + Title -->
            <div class="flex items-center gap-3 overflow-hidden">

                @if (setting('sidebar_logo'))
                    <img src="{{ asset('storage/' . setting('sidebar_logo')) }}"
                        class="w-10 h-10 rounded-xl object-cover bg-white p-1 shrink-0">
                @else
                    <div
                        class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center font-bold text-lg shrink-0">
                        T
                    </div>
                @endif

                <div x-show="open" x-transition.opacity>
                    <h2 class="text-lg font-bold leading-tight whitespace-nowrap">
                        {{ setting('app_name', 'Tasbeeh') }}
                    </h2>
                    <p class="text-xs text-gray-400 whitespace-nowrap">
                        Admin Panel
                    </p>
                </div>

            </div>

            <!-- Toggle -->
            <button @click="open = !open" class="ml-2 bg-gray-800 hover:bg-indigo-600 px-2 py-1 rounded-lg transition">
                ☰
            </button>

        </div>

    </div>

    <!-- Menu -->
    <ul class="space-y-3 text-sm font-medium">

        @can('dashboard.view')
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('dashboard') }}">

                    <span>🏠</span>
                    <span x-show="open">Dashboard</span>

                </a>
            </li>
        @endcan

        @can('users.view')
            <li>
                <a href="{{ route('users.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('users.*') }}">

                    <span>👥</span>
                    <span x-show="open">Users</span>

                </a>
            </li>
        @endcan

        @can('admins.view')
            <li>
                <a href="{{ route('admins.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('admins.*') }}">

                    <span>🛡️</span>
                    <span x-show="open">Admins</span>

                </a>
            </li>
        @endcan

        @can('reports.view')
            <li>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('reports.*') }}">

                    <span>📊</span>
                    <span x-show="open">Reports</span>

                </a>
            </li>
        @endcan

        @can('roles.manage')
            <li>
                <a href="{{ route('roles.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('roles.*') }}">

                    <span>🔐</span>
                    <span x-show="open">Roles</span>

                </a>
            </li>
        @endcan

        @can('settings.manage')
            <li>
                <a href="{{ route('settings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('settings.*') }}">

                    <span>⚙️</span>
                    <span x-show="open">Settings</span>

                </a>
            </li>
        @endcan

        @can('waitlist.view')
            {{-- or new permission --}}
            <li>
                <a href="{{ route('waitlist.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeClass('waitlist.*') }}">
                    <span>📧</span>
                    <span x-show="open">Waitlist</span>
                </a>
            </li>
        @endcan

    </ul>

</div>
