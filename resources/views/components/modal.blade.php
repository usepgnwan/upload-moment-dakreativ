{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

@props(['id'=>null, 'maxWidth'=>'null','backdrop'=>null, 'custom'=>null])

@php
$id = $id ?? md5($attributes->wire('model'));

switch ($maxWidth ?? '2xl') {
    case 'sm':
        $maxWidth = 'sm:max-w-sm';
        break;
    case 'md':
        $maxWidth = 'sm:max-w-md';
        break;
    case 'lg':
        $maxWidth = 'sm:max-w-lg';
        break;
    case 'xl':
        $maxWidth = 'sm:max-w-xl';
        break;
    case '2xl':
    default:
        $maxWidth = 'sm:max-w-2xl';
        break;
}
@endphp

<div
    x-data="{
        show: @entangle($attributes->wire('model')),
        focusables() {
            let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
            return [...$el.querySelectorAll(selector)]
                .filter(el => !el.hasAttribute('disabled'));
        },
        firstFocusable() { return this.focusables()[0]; },
        lastFocusable() { return this.focusables().slice(-1)[0]; },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable(); },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable(); },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1); },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1; },
        autofocus() { let focusable = $el.querySelector('[autofocus]'); if (focusable) focusable.focus(); },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-hidden'); // Prevent body scrolling
            setTimeout(autofocus, 10);
        } else {
            document.body.classList.remove('overflow-hidden'); // Restore body scrolling
        }
    })"
    x-on:close.stop="show = false"
    @if(is_null($custom)) x-on:keydown.escape.window="show = false" @endif
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    id="{{ $id }}"
    class="fixed top-0 bottom-0 inset-0 z-50  px-4  pt-6 sm:px-0 sm:justify-center overflow-x-hidden overflow-y-auto"
    style="display: none;"
>
    <!-- Background overlay -->
    <div x-show="show" class="fixed inset-0 transform transition-all" @if(is_null($custom))   x-on:click="show = false" @endif
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75">
        {!! $backdrop ?? '' !!}
        </div>
    </div>

    <!-- Modal container with scrollable content -->
    <div x-show="show"  class="bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all sm:w-full {{ $maxWidth }}  mx-auto   {{$custom}} "
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="p-4 ">
            <!-- Your modal content here -->
            {{ $slot }}
        </div>
    </div>
</div>
