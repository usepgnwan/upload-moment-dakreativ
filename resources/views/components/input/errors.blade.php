@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'inline' => false,
    'paddingless' => false,
    'borderless' => false,
])

<div class="mb-3">
    <div class="mt-1 relative rounded-md shadow-sm">
        {{ $slot }}

        @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
        @endif

        @if ($helpText)
        <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
        @endif
    </div>
</div>
