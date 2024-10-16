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

    @if (request()->routeIs('dashboard'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js" data-navigate-track="reload"></script>
    @endif

    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen {{ Auth::user()->role == 'admin' ? 'bg-neutral-900 p-2' : '' }}">
        <livewire:layout.navigation />
        @if (Auth::user()->role == 'admin')
            @include('dashboard.partials.sidebar')
        @endif

        <!-- Page Content -->
        <main
            class="bg-neutral-100  min-h-screen {{ Auth::user()->role == 'admin' ? 'xl:ml-64 rounded-3xl m-2' : '' }}">
            @if (Auth::user()->role == 'admin')
                @if (request()->routeIs('dashboard'))
                    <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-bold capitalize leading-none">Halo, {{ auth()->user()->name }}!</h3>
                            <p class="text-neutral-500">Welcome to your dashboard</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <p class="text-black font-semibold">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                            <div class="flex items-center justify-center w-9 h-9 rounded-full bg-neutral-200/80">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <rect x="40" y="40" width="176" height="176" rx="8" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="176" y1="24" x2="176" y2="56" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="80" y1="24" x2="80" y2="56" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="40" y1="88" x2="216" y2="88" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <circle cx="128" cy="132" r="12" />
                                    <circle cx="172" cy="132" r="12" />
                                    <circle cx="84" cy="172" r="12" />
                                    <circle cx="128" cy="172" r="12" />
                                    <circle cx="172" cy="172" r="12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center print:hidden">
                        <button onclick="history.back()"
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
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                                                class="w-4 h-4 mr-2">
                                                <rect width="256" height="256" fill="none" />
                                                <polyline points="96 48 176 128 96 208" fill="none"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="22" />
                                            </svg>
                                        @endif
                                        <a href="{{ url()->current() }}"
                                            class="{{ $loop->iteration == $loop->count ? 'text-black font-semibold' : 'text-neutral-500' }} hover:text-neutral-900 capitalize">
                                            {{ str_replace('-', ' ', $segment) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                @endif
            @else
                <div class="border-b border-neutral-300 p-4 sm:px-6 flex items-center justify-between">
                    <div class="shrink-0">
                        <div>
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-10 invert" />
                            </a>
                        </div>
                    </div>
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="text-xs inline-flex uppercase  py-2 min-[480px]:py-3 px-3 min-[480px]:px-5 border bg-[#111116] border-borderColor rounded-lg text-light">
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <!-- Authentication -->
                                    <button type="submit" class="w-full text-start">
                                        <x-dropdown-link>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @if (request()->routeIs('kitchen'))
                    @if (request()->routeIs('kitchen'))
                        <div class="px-4 mt-8 sm:px-6">
                            <h3 class="text-xl font-bold capitalize leading-none">Halo, {{ auth()->user()->name }}!
                            </h3>
                            <p class="text-neutral-500">Welcome to your dashboard</p>
                        </div>
                    @else
                        <div class="px-4 mt-8 sm:px-6">
                            <a href="{{ route('kitchen') }}" wire:navigate
                                class="inline-flex gap-3 items-center hover:underline">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <line x1="216" y1="128" x2="40" y2="128"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="16" />
                                    <polyline points="112 56 40 128 112 200" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="24" />
                                </svg>
                                Back
                            </a>
                        </div>
                    @endif
                @endif
            @endif
            <div class="p-4 sm:p-6 {{ Auth::user()->role != 'admin' ? '!py-0' : '' }}">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
