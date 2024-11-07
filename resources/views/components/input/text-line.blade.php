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

<div class="flex ">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 py-2 border-0 border-b-2 border-gray-300 dark:border-gray-600 text-black">
            {!! $leadingAddOn !!}
        </span>
    @endif
    <input {{ $attributes->merge(['class' => 'form-input-line' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>
</div>
