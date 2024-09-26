@if (!request()->routeIs('home.dashboard'))
    <nav
        class="bg-black border border-borderColor p-2.5 w-max rounded-2xl absolute top-10 left-1/2 -translate-x-1/2 xl:translate-x-0 xl:left-10 z-50">
        <ul class="flex items-center w-full">
            <li class="mr-3">
                <button id="openNav"
                    class="border border-borderColor rounded-lg inline-flex items-center justify-center w-9 h-9">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="40" y1="128" x2="216" y2="128" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="40" y1="64" x2="216" y2="64" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="40" y1="192" x2="216" y2="192" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                </button>
            </li>
            <li class="mr-5 leading-3">
                <a href="{{ route('home') }}" wire:navigate.hover class="inline-block">
                    <img src="{{ asset('assets/logo.svg') }}" class="h-8" alt="{{ config('app.name') }}">
                </a>
            </li>
            <li class="hidden md:block">
                <a href="{{ route('menu') }}" wire:navigate.hover
                    class="text-xs uppercase p-3 border border-transparent hover:bg-[#111116] hover:border-borderColor duration-300 rounded-lg">
                    Menu
                </a>
            </li>
            <li class="hidden md:block ml-1">
                <a href="{{ route('about') }}" wire:navigate.hover
                    class="text-xs uppercase p-3 border border-transparent hover:bg-[#111116] hover:border-borderColor duration-300 rounded-lg">
                    About
                </a>
            </li>
            <li class="shrink-0 ml-1">
                @if (!Auth::check())
                    <a href="{{ route('login') }}"
                        class="text-xs uppercase inline-block py-2 min-[480px]:py-3 px-3 min-[480px]:px-5 border bg-[#111116] border-borderColor rounded-lg">
                        Login
                    </a>
                @else
                    <a href="{{ route('home.dashboard') }}" wire:navigate
                        class="text-xs uppercase inline-block py-2 min-[480px]:py-3 px-3 min-[480px]:px-5 border bg-[#111116] border-borderColor rounded-lg">
                        Dashboard
                    </a>
                @endif
            </li>
        </ul>
    </nav>

    <div class="fixed top-12 right-16 z-50">
        <livewire:home.cart.icon>
    </div>

    <div class="bg-black h-screen hidden" id="overlayNav">
        <div class="fixed p-[22px] inset-0 z-50 block">
            <div class="border border-borderColor bg-[#111111] h-full rounded-2xl p-6">
                <button id="closeNav"
                    class="border border-borderColor rounded-lg inline-flex items-center justify-center w-9 h-9 absolute">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="200" y1="56" x2="56" y2="200" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="200" y1="200" x2="56" y2="56" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                </button>
                <div class="flex items-center justify-center w-full h-full">
                    <ul class="flex flex-col items-center gap-4 navMenu">
                        <li>
                            <svg width="42" height="13" viewBox="0 0 42 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="6.5" x2="30" y2="6.5" stroke="#333330" />
                                <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                    transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                                <rect x="35.3638" y="0.353553" width="8.5" height="8.5"
                                    transform="rotate(45 35.3638 0.353553)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                        </li>
                        <li class="slide-right">
                            <a href="{{ route('menu') }}" wire:navigate.hover
                                class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                menu
                            </a>
                        </li>
                        <li class="slide-right">
                            <a href=""
                                class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                reservation
                            </a>
                        </li>
                        <li class="slide-right">
                            <a href="{{ route('about') }}" wire:navigate.hover
                                class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                about
                            </a>
                        </li>
                        <li class="slide-right">
                            <a href=""
                                class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                contact
                            </a>
                        </li>
                        <li class="slide-right">
                            <a href=""
                                class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                blog
                            </a>
                        </li>
                        @if (!Auth::check())
                            <li class="slide-right">
                                <a href="{{ route('login') }}"
                                    class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                    login
                                </a>
                            </li>
                        @else
                            <li class="slide-right">
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="font-forum uppercase inline-block md:text-7xl text-5xl min-[480px]:text-6xl lg:text-7xl hover:text-yellow duration-500">
                                        logout
                                    </button>
                                </form>
                            </li>
                        @endif
                        <li>
                            <svg width="42" height="13" viewBox="0 0 42 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="6.5" x2="30" y2="6.5"
                                    stroke="#333330" />
                                <rect x="6.5" y="0.48954" width="8.5" height="8.5"
                                    transform="rotate(45 6.5 0.48954)" stroke="#333330" stroke-width="0.5" />
                                <rect x="35.3638" y="0.353553" width="8.5" height="8.5"
                                    transform="rotate(45 35.3638 0.353553)" stroke="#333330" stroke-width="0.5" />
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
