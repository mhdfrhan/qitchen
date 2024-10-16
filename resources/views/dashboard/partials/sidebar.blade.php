<aside class="w-64 h-screen bg-neutral-900 hidden xl:block fixed top-0 left-0 bottom-0 z-50 ">
    <!-- Logo -->
    <div class="shrink-0 flex items-center p-5">
        <a href="{{ route('home') }}">
            <x-application-logo class="block h-10" />
        </a>
    </div>
    <ul class="flex flex-col p-5 space-y-4 min-h-screen">
        @if (Auth::user()->role == 'admin')
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M33.6,145.5A96,96,0,0,1,96,37.5v72Z" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M128,128.42V32A96,96,0,1,1,45.22,176.64Z" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.tables')" :active="request()->routeIs('dashboard.tables')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="24" y1="72" x2="24" y2="192" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="232" y1="72" x2="232" y2="192" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="128" y1="72" x2="128" y2="136" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="8" y1="72" x2="248" y2="72" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="24" y1="136" x2="232" y2="136" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="64" y1="104" x2="88" y2="104" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="168" y1="104" x2="192" y2="104" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    {{ __('Manage Tables') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.menu')" :active="request()->routeIs('dashboard.menu')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M48,112a80,80,0,0,1,160,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M89.6,112A80,80,0,0,1,168,48a81.61,81.61,0,0,1,8.61.46" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <path d="M134.66,112A80.13,80.13,0,0,1,193,65.4" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path
                            d="M88,199.3A96,96,0,0,1,32,112H224a96,96,0,0,1-56,87.3V208a8,8,0,0,1-8,8H96a8,8,0,0,1-8-8Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                    </svg>
                    {{ __('Manage Menus') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.reservations')" :active="request()->routeIs('dashboard.reservations')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="128" y1="128" x2="216" y2="128" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <line x1="128" y1="64" x2="216" y2="64" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <line x1="128" y1="192" x2="216" y2="192" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <polyline points="40 64 56 80 88 48" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <polyline points="40 128 56 144 88 112" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <polyline points="40 192 56 208 88 176" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    {{ __('Reservations') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.users')" :active="request()->routeIs('dashboard.users')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M192,120a59.91,59.91,0,0,1,48,24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M16,144a59.91,59.91,0,0,1,48-24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="128" cy="144" r="40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M72,216a65,65,0,0,1,112,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M161,80a32,32,0,1,1,31,40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M64,120A32,32,0,1,1,95,80" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    {{ __('Users') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.articles')" :active="request()->is('dashboard/articles*')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M168,224l-56-40L56,224V72a8,8,0,0,1,8-8h96a8,8,0,0,1,8,8Z" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <path d="M88,32H192a8,8,0,0,1,8,8V192" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    {{ __('Articles') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link class="inline-flex gap-3" :href="route('dashboard.reports')" :active="request()->routeIs('dashboard.reports')" wire:navigate>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path d="M168,224H56a8,8,0,0,1-8-8V72a8,8,0,0,1,8-8h80l40,40V216A8,8,0,0,1,168,224Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <path d="M80,64V40a8,8,0,0,1,8-8h80l40,40V184a8,8,0,0,1-8,8H176" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <line x1="88" y1="152" x2="136" y2="152" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <line x1="88" y1="184" x2="136" y2="184" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                    </svg>
                    {{ __('Reports') }}
                </x-nav-link>
            </li>
        @endif
    </ul>
    @if (Auth::user()->role == 'admin')
        <div class="absolute bottom-0 w-full p-5">
            <div class="p-3 border border-borderColor rounded-lg bg-[#111116]">
                <x-dropdown align="top-right" width="48">
                    <x-slot name="trigger">
                        <button class="text-xs w-full uppercase text-light flex items-center justify-between">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div>
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
                        <x-dropdown-link :href="route('dashboard.profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
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
    @endif
</aside>
