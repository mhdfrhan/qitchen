<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ $title ?? '' }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-neutral-900 p-2">
        <livewire:layout.navigation />
        @include('dashboard.partials.sidebar')

        <!-- Page Content -->
        <main class="xl:ml-64 rounded-3xl bg-neutral-100 m-2 min-h-screen">
            @if (request()->routeIs('dashboard'))
                <div class="border-b border-neutral-300 p-4 sm:px-6">
                    <h3 class="text-xl font-bold capitalize leading-none">Halo, {{ auth()->user()->name }}!</h3>
                    <h6 class="text-neutral-500">{{ date('F j, Y') }}</h6>
                </div>
            @else
                <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center">
                    <button onclick="history.back() ? history.back() : window.location = '/dashboard'"
                        class="border-r border-neutral-300 mr-4 pr-4">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="216" y1="128" x2="40" y2="128" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24" />
                        </svg>
                    </button>

                    {{-- breadcrumb --}}
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            @foreach (request()->segments() as $index => $segment)
                                <li class="text-neutral-500 flex items-center">
                                    @if ($index > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" class="w-4 h-4 mr-2">
                                            <rect width="256" height="256" fill="none"/>
                                            <polyline points="96 48 176 128 96 208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="22"/>
                                        </svg>
                                    @endif
                                    <a href="{{ url()->current() }}" class="text-neutral-700 hover:text-neutral-900 capitalize">
                                        {{ str_replace('-', ' ', $segment) }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
            @endif
            <div class="p-4 sm:p-6 ">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
