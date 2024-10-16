<x-home-dashboard-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <div class="mb-6 flex flex-wrap gap-3 items-center justify-between">
            <div>
                <h3 class="text-2xl capitalize font-bold">Welcome, {{ auth()->user()->name }}👋</h3>
                <p class="text-textColor/70">This is the dashboard page used to display your information</p>
            </div>
            <div class="flex items-center gap-3">
                <p class="text-textColor/70 font-semibold">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-neutral-900">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <rect x="40" y="40" width="176" height="176" rx="8" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="176" y1="24" x2="176" y2="56" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="80" y1="24" x2="80" y2="56" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="40" y1="88" x2="216" y2="88" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="128" cy="132" r="12" />
                        <circle cx="172" cy="132" r="12" />
                        <circle cx="84" cy="172" r="12" />
                        <circle cx="128" cy="172" r="12" />
                        <circle cx="172" cy="172" r="12" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-neutral-900 p-4 rounded-2xl">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-800">
                        <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <circle cx="128" cy="128" r="32" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <rect x="16" y="64" width="224" height="128" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M240,104a48.85,48.85,0,0,1-40-40" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M200,192a48.85,48.85,0,0,1,40-40" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M16,152a48.85,48.85,0,0,1,40,40" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <path d="M56,64a48.85,48.85,0,0,1-40,40" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold leading-none">
                            Rp.
                            {{ number_format(
                                Auth::user()->reservations->reject(function ($reservation) {
                                        return in_array($reservation->status, ['pending', 'cancelled']);
                                    })->sum('total_amount'),
                                0,
                                ',',
                                '.',
                            ) }}
                        </h1>
                        <h3 class="font-semibold text-neutral-500 text-sm">Total Spending</h3>
                    </div>
                </div>
            </div>
            <div class="bg-neutral-900 p-4 rounded-2xl">
                <div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-800">
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <polyline points="88 136 112 160 168 104" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="22" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold leading-none">{{ count(Auth::user()->reservations) }}</h1>
                            <h3 class="font-semibold text-neutral-500 text-sm">Reservation Count</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-neutral-900 p-4 rounded-2xl">
                <div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-neutral-800">
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <ellipse cx="96" cy="84" rx="80" ry="36" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <path d="M16,84v40c0,19.88,35.82,36,80,36s80-16.12,80-36V84" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="64" y1="117" x2="64" y2="157" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <path
                                    d="M176,96.72c36.52,3.34,64,17.86,64,35.28,0,19.88-35.82,36-80,36-19.6,0-37.56-3.17-51.47-8.44"
                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="16" />
                                <path d="M80,159.28V172c0,19.88,35.82,36,80,36s80-16.12,80-36V132" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="192" y1="165" x2="192" y2="205" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                                <line x1="128" y1="117" x2="128" y2="205" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="16" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold leading-none">
                                {{ number_format(Auth::user()->loyalty_points, 0, ',', '.') }}</h1>
                            <h3 class="font-semibold text-neutral-500 text-sm">Loyalty Points</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="text-lg font-semibold">Statistics</h3>
            <div class="mt-2">
                <livewire:home.dashboard.chart>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="text-lg font-semibold">My Reservations</h3>
            <p class="text-textColor/50 text-sm">Click on the reservation to see detail</p>
            <div class="mt-4">
                <div class="w-full overflow-x-auto">
                    <livewire:home.dashboard.reservation>
                </div>
            </div>
        </div>
    </section>
</x-home-dashboard-layout>
