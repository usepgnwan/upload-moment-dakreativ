@props(['active' => false])
@php
    $classes = "lg:hover:text-[#007bff] text-sm  block font-semibold text-[15px] ";
    $classes .= ($active ?? false) ? 'text-[#007bff] ' : 'dark:text-slate-400 text-gray-500 lg:text-white ';
@endphp


<li class='max-lg:border-b max-lg:py-2 px-2 whitespace-nowrap max-lg:dark:border-b-gray-500'>
    <a wire:navigate  {{ $attributes->merge(['class'=>  $classes ])}}>{{$slot}}</a>
</li>
