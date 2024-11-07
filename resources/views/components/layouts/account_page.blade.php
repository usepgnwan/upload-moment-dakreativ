<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title ." | " .  config('app.name') : config('app.name')  }}</title>


    <meta name="description" content="{{ isset($title) ? $title : config('app.name')  }}">

    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class=" dark:text-slate-400  dark:bg-gray-700 bg-slate-200">
    <x-partials.navigations-home :check="'dashboard'"></x-partials.navigations-home>
    <x-partials.dashboard.side-bar-menu></x-partials.dashboard.side-bar-menu>
    <div class=" w-full   min-h-screen">
        <div class="w-4/5  ml-auto p-4 px-8 mt-1 octa-body-content transition-all ease-in-out  delay-75 max-lg:w-full">
            {{ $slot }}
        </div>
    </div>

    <x-partials.footer :check="'dashboard'"></x-partials.footer>



    <script src=" https://cdn.jsdelivr.net/npm/air-datepicker@3.5.3/air-datepicker.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/air-datepicker@3.5.3/air-datepicker.min.css " rel="stylesheet">

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
    <script src="{{ asset('/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('/vendor/tinymce_mathjax/plugin.js')}}"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <x-notification />
    @vite(['resources/js/app.js'])
    @livewireScripts
    @stack('scripts')
</body>

</html>
