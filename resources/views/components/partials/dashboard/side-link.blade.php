@props(['active' => false, "multi" => false, "icon" => '', "title"=>"", "link"=>""])

@if (!$multi)

@php
$classes = "flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 group ";
$classes .= ($active ?? false) ? ' bg-blue-500 text-white' : 'text-gray-900';

$icon_class = " $icon w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white ";
$icon_class .= ($active ?? false) ? ' text-white' : 'text-gray-500';
@endphp

<li>
    <a wire:navigate {{ $attributes->merge(['class'=>  $classes ])}}>
        @if($icon !='')
            <span {{ $attributes->merge(['class'=>  $icon_class ])}}></span>
        @endif
        {{$slot}}
    </a>
</li>

@else

@php
$classes = "flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 group dropdown-toggle-button group/rotate menu-group-dashboard ";
$classes .= ($active ?? false) ? '  ' : 'text-gray-900';

$icon_class = " $icon  text-gray-500 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white ";


$_title = strtolower(str_replace(' ', '_', $title));
@endphp
<button type="button" {{ $attributes->merge(['class'=>  $classes ])}} aria-controls="data-toggle-{{ $_title }}" data-collapse-toggle="data-toggle-{{ $_title }}">

    @if($icon !='')
        <span class="{{$icon_class}}"></span>
    @endif

    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
        {{ $title }}
    </span>
    <span class="text-[10px] w-3 h-3 icon-arrow  icon-[simple-line-icons--arrow-left] group-hover/rotate:-rotate-90 lg:group-hover/focus: ease-in duration-300 "></span>
</button>
<ul id="data-toggle-{{ $_title }}" class="@if(!$active) hidden @endif py-2 space-y-2">
    {{ $link }}
</ul>

@endif
