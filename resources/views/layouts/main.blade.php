<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/logo.svg') }}" type="image/x-icon">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Scripts -->
    <script defer src="{{ asset('js/script.js') }}" data-navigate-track="reload"></script>
    @if (request()->routeIs('home.dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js" data-navigate-track="reload"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    @endif

    @stack('styles')

    @livewireStyles
</head>

<body class="bg-black text-light">

    <main class="{{ !request()->routeIs('home.dashboard') ? 'min-h-screen' : '' }} w-auto">
        {{ $slot }}

        @persist('chatbot')
            <livewire:home.chatbot>
        @endpersist
    </main>


    {{-- @include('home.partials.footer') --}}

    @stack('scripts')


    @livewireScripts
    @stack('scripts-livewire')
</body>

</html>
