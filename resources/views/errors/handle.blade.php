<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{  isset($title) ? $title ." | " .  config('app.name') : config('app.name')  }}</title>

        <meta name="description" content="{{ isset($title) ? $title : config('app.name')  }}">
        <link rel="icon" href="{{ asset('asset/img/home/logo-rifaya.png') }}" type="image/png">

        @vite(['resources/css/app.css'])

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-FXP4219XLM"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-FXP4219XLM');
        </script>
    </head>
    <body class=" dark:text-slate-400  dark:bg-gray-700">
        @if ($statusCode == 404)
            <x-errors :errorCode="__('404')" :msg="__('Halaman tidak ditemukan')"></x-errors>
        @elseif ($statusCode == 406)
            <x-errors :errorCode="__('406')" :msg="__('<span class=font-bold>Mohon maaf</span><br> Saat ini pendaftaran kami ditutup sementara karena tingginya antusiasme para tutor yang mendaftar.<br> Kami memerlukan waktu untuk memverifikasi data tutor yang sudah masuk.
            <br><br>
            Terima kasih atas pengertiannya.')"></x-errors>
        @endif
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
        <script src="{{ asset('/vendor/tinymce/tinymce.min.js')}}"></script>
        <script src="{{ asset('/vendor/tinymce_mathjax/plugin.js')}}"></script>
        <x-notification />
        @livewireScripts
        @vite(['resources/js/app.js'])
        @stack('scripts')
    </body>
</html>
