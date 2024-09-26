<aside class="w-64 h-screen bg-neutral-900 hidden xl:block fixed top-0 left-0 bottom-0 z-50 ">
    <!-- Logo -->
    <div class="shrink-0 flex items-center p-5">
        <a href="{{ route('home') }}">
            <x-application-logo class="block h-10" />
        </a>
    </div>
    <ul class="flex flex-col p-5 space-y-4 min-h-screen">
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
            <x-nav-link class="inline-flex gap-3" :href="route('dashboard.menu')" :active="request()->routeIs('dashboard.menu')" wire:navigate>
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <path d="M48,112a80,80,0,0,1,160,0" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16" />
                    <path d="M89.6,112A80,80,0,0,1,168,48a81.61,81.61,0,0,1,8.61.46" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <path d="M134.66,112A80.13,80.13,0,0,1,193,65.4" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <path d="M88,199.3A96,96,0,0,1,32,112H224a96,96,0,0,1-56,87.3V208a8,8,0,0,1-8,8H96a8,8,0,0,1-8-8Z"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="16" />
                </svg>
                {{ __('Daftar Menu') }}
            </x-nav-link>
        </li>
    </ul>
    <div class="absolute bottom-0 w-full p-5">
        <div class="p-3 border border-borderColor rounded-lg bg-[#111116]">
            <x-dropdown align="top-right" width="48">
                <x-slot name="trigger">
                    <button class="text-xs w-full uppercase text-light flex items-center justify-between">
                        <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                            x-on:profile-updated.window="name = $event.detail.name"></div>

                        <div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
</aside>
