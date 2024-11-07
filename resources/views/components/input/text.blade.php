{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

@props([
    'leadingAddOn' => false,
])

<div class="flex rounded-md shadow-sm">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 py-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600">
            {!! $leadingAddOn !!}
        </span>
    @endif
    <input {{ $attributes->merge(['class' => 'form-input-rifaya' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>
</div>
