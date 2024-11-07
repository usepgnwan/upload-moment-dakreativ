<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/css/app.css'])
        @livewireStyles
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Noto+Sans+Math&display=swap" rel="stylesheet">

    </head>
    <body>
        {{ $slot }}
        <x-notification />
        @vite(['resources/js/app.js'])
        @livewireScripts
        @stack('scripts')
    </body>
</html>
