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
    'placeholder' => null,
    'trailingAddOn' => null,
    'multiple' => false,
])

<div class="flex" x-data="{ selected: @entangle($attributes->wire('model')) }" x-init="

    if ($($refs.select).next('.select2-container')) {
            $($refs.select).next('.select2-container').remove();
    }


    $($refs.select).select2({
        placeholder: '{{ $placeholder }}',
        allowClear: true
    }).on('change', function() {
        // Update Alpine.js model whenever select2 changes
        selected = $($refs.select).val();
    });

    Livewire.on('reinitSelect2', () => {

        setTimeout(() => {
            $($refs.select).select2('destroy');
            $($refs.select).select2({
                placeholder: '{{ $placeholder }}',
                allowClear: true
            }).on('change', function() {
                // Update Alpine.js model whenever select2 changes
                selected = $($refs.select).val();
            });
        }, 0);

    });

"

>
  <select @if ($multiple) multiple="multiple" @endif  x-ref="select" x-bind:value="selected" {{ $attributes->merge(['class' => 'select2 rounded-md block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}>
   @if ($placeholder)
        <option disabled value="">{{ $placeholder }}</option>
    @endif

    {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
</div>
