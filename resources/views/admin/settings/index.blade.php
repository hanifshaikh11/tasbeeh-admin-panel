<x-app-layout>

    <div class="bg-white rounded-2xl shadow p-6">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
            <p class="text-sm text-gray-500">
                Manage application configuration
            </p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- App Name -->
                <div>
                    <label class="block font-medium mb-2">App Name</label>
                    <input type="text" name="app_name" value="{{ setting('app_name') ?? '' }}"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                    @error('app_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Page Title -->
                <div>
                    <label class="block font-medium mb-2">Page Title</label>
                    <input type="text" name="page_title" value="{{ setting('page_title') }}"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                    @error('page_title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Email -->
                <div>
                    <label class="block font-medium mb-2">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ setting('contact_email') }}"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Contact Phone -->
                <div>
                    <label class="block font-medium mb-2">Contact Phone</label>
                    <input type="text" name="contact_phone" value="{{ setting('contact_phone') }}"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Sidebar Logo -->
                <div>
                    <label class="block font-medium mb-2">Sidebar Logo</label>
                    <input type="file" name="sidebar_logo"
                        class="w-full border rounded-xl px-4 py-2">
                </div>

                <!-- Favicon -->
                <div>
                    <label class="block font-medium mb-2">Favicon</label>
                    <input type="file" name="favicon"
                        class="w-full border rounded-xl px-4 py-2">
                </div>

            </div>

            <!-- Address -->
            <div>
                <label class="block font-medium mb-2">Address</label>
                <textarea name="address" rows="3"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ setting('address') }}</textarea>
            </div>

            <!-- Footer Text -->
            <div>
                <label class="block font-medium mb-2">Footer Text</label>
                <input type="text" name="footer_text" value="{{ setting('footer_text') }}"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">
                    Save Settings
                </button>
            </div>
        </form>
    </div>

</x-app-layout>