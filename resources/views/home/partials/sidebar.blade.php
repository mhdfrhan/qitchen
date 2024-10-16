<div class="lg:border-r border-borderColor lg:p-4 border-b lg:border-b-0 h-full print:hidden" x-data="{ open: false }">
    <div class="flex items-center justify-between lg:block gap-3">
        <div>
            <x-application-logo class="w-28" />
        </div>
        <div class="lg:hidden">
            <button type="button" @click="open = !open"
                class="w-9 h-9 flex items-center justify-center border border-borderColor bg-neutral-900 rounded-md">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <circle cx="128" cy="128" r="24" fill="none" stroke="currentColor"
                        stroke-miterlimit="10" stroke-width="16" />
                    <circle cx="128" cy="48" r="24" fill="none" stroke="currentColor"
                        stroke-miterlimit="10" stroke-width="16" />
                    <circle cx="128" cy="208" r="24" fill="none" stroke="currentColor"
                        stroke-miterlimit="10" stroke-width="16" />
                </svg>
            </button>
        </div>
    </div>
    <div class="mt-6 lg:hidden" x-show="open" x-transition.duration.200ms>
        <ul class="flex flex-col space-y-3">
            <li>
                <a href="{{ route('home.dashboard') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->routeIs('home.dashboard') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path
                            d="M104,216V152h48v64h64V120a8,8,0,0,0-2.34-5.66l-80-80a8,8,0,0,0-11.32,0l-80,80A8,8,0,0,0,40,120v96Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="22" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('home.profile') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->routeIs('home.profile') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="128" cy="120" r="40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M63.8,199.37a72,72,0,0,1,128.4,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    My Profile
                </a>
            </li>
            <li>
                <a href="{{ route('home.reservations') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->routeIs('home.reservations') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="80" y1="40" x2="80" y2="88" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="80" y1="128" x2="80" y2="224" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M208,168H152s0-104,56-128V224" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M48,40,40,88a40,40,0,0,0,80,0l-8-48" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    My Reservations
                </a>
            </li>
        </ul>
    </div>
    <div class="mt-6 hidden lg:block">
        <ul class="flex flex-col space-y-3">
            <li>
                <a href="{{ route('home.dashboard') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->routeIs('home.dashboard') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path
                            d="M104,216V152h48v64h64V120a8,8,0,0,0-2.34-5.66l-80-80a8,8,0,0,0-11.32,0l-80,80A8,8,0,0,0,40,120v96Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="22" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('home.profile') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->routeIs('home.profile') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="128" cy="120" r="40" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M63.8,199.37a72,72,0,0,1,128.4,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    My Profile
                </a>
            </li>
            <li>
                <a href="{{ route('home.reservations') }}" wire:navigate
                    class="text-sm uppercase py-2 px-4 duration-300 rounded-lg active:scale-90 flex items-center gap-3 {{ request()->is('user/dashboard/reservations*') ? 'bg-neutral-900 font-bold' : 'hover:bg-neutral-900' }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="80" y1="40" x2="80" y2="88" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <line x1="80" y1="128" x2="80" y2="224" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <path d="M208,168H152s0-104,56-128V224" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M48,40,40,88a40,40,0,0,0,80,0l-8-48" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    My Reservations
                </a>
            </li>
        </ul>
    </div>
    <div class="w-full mt-6">

    </div>
</div>
