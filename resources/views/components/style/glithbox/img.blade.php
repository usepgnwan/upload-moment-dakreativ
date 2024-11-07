@props(['url'=>'', 'alt'=>''])

    <img src="{{ $url }}" alt="{{ $alt }}" {{ $attributes->merge(['class' => 'object-contain hover:grayscale transition-all duration-700 ease-in-out  w-full h-full '])  }}>
