<div class="bg-white rounded-2xl shadow p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $title }}</h1>
        @if (isset($subtitle))
            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
        @endif
    </div>

    {{ $slot }}
</div>
