<div>
    <div class="flex items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">Statistics</h1>
        </div>
    </div>
    <div class="grid lg:grid-cols-2 gap-4 lg:gap-6">
        <div class="bg-white p-6 rounded-3xl shadow-lg shadow-neutral-200">
            <h3 class="text-lg font-semibold">Total Reservations per Month</h3>
            <canvas id="totalReservations" class="w-full max-h-80"></canvas>
        </div>

        <div class="rounded-3xl shadow-lg shadow-neutral-200 overflow-hidden">
            <div class="grid lg:grid-cols-2 lg:grid-rows-2 gap-2 lg:h-full">
                <div class="bg-white p-5 w-full h-full">
                    <div class="flex flex-col h-full">
                        <div class="flex items-start justify-between gap-3 h-full">
                            <div>
                                <h3 class="text-neutral-500 font-medium">Total Revenue</h3>
                            </div>
                            <div
                                class="w-14 h-14 flex items-center justify-center bg-neutral-200/60 rounded-full text-neutral-700">
                                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
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
                        </div>
                        <div>
                            <p class="text-4xl font-bold">
                                Rp.
                                {{ isset($totalRevenueByMonth[date('F')]) ? number_format($totalRevenueByMonth[date('F')], 0, ',', '.') : '0' }}
                            </p>
                            <span
                                class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs mt-2 {{ $revenueChangePercentage < 0 ? 'bg-red-200 text-red-700' : 'bg-green-200 text-green-700' }}">
                                @if (isset($revenueChangePercentage))
                                    @if ($revenueChangePercentage == 100)
                                        {{ $revenueChangePercentage }}%
                                    @else
                                        {{ number_format($revenueChangePercentage, 1) }}%
                                    @endif
                                @else
                                    -
                                @endif
                            </span>
                            <span class="text-sm text-black">Than last month</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 w-full h-full">
                    <div class="flex flex-col h-full">
                        <div class="flex items-start justify-between gap-3 h-full">
                            <div>
                                <h3 class="text-neutral-500 font-medium">Total Reservations</h3>
                            </div>
                            <div
                                class="w-14 h-14 flex items-center justify-center bg-neutral-200/60 rounded-full text-neutral-700">
                                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <line x1="128" y1="128" x2="216" y2="128" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="128" y1="64" x2="216" y2="64" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="128" y1="192" x2="216" y2="192"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="16" />
                                    <polyline points="40 64 56 80 88 48" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <polyline points="40 128 56 144 88 112" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <polyline points="40 192 56 208 88 176" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-4xl font-bold">
                                {{ $totalReservations }}
                            </p>
                            <span
                                class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs mt-2 {{ $reservationChangePercentage < 0 ? 'bg-red-200 text-red-700' : 'bg-green-200 text-green-700' }}">
                                @if (isset($reservationChangePercentage))
                                    {{ number_format($reservationChangePercentage, 0) }}%
                                @else
                                    -
                                @endif
                            </span>
                            <span class="text-sm text-black">Than last month</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 w-full h-full">
                    <div class="flex flex-col h-full">
                        <div class="flex items-start justify-between gap-3 h-full">
                            <div>
                                <h3 class="text-neutral-500 font-medium">Total Customers</h3>
                            </div>
                            <div
                                class="w-14 h-14 flex items-center justify-center bg-neutral-200/60 rounded-full text-neutral-700">
                                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <path d="M192,120a59.91,59.91,0,0,1,48,24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <path d="M16,144a59.91,59.91,0,0,1,48-24" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <circle cx="128" cy="144" r="40" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <path d="M72,216a65,65,0,0,1,112,0" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <path d="M161,80a32,32,0,1,1,31,40" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <path d="M64,120A32,32,0,1,1,95,80" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-4xl font-bold">
                                {{ $totalCustomers }}
                            </p>
                            <span
                                class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs mt-2 {{ $customerChangePercentage < 0 ? 'bg-red-200 text-red-700' : 'bg-green-200 text-green-700' }}">
                                @if (isset($customerChangePercentage))
                                    {{ number_format($customerChangePercentage, 0) }}%
                                @else
                                    -
                                @endif
                            </span>
                            <span class="text-sm text-black">Than last month</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 w-full h-full">
                    <div class="flex flex-col h-full">
                        <div class="flex items-start justify-between gap-3 h-full">
                            <div>
                                <h3 class="text-neutral-500 font-medium">Total Menus</h3>
                            </div>
                            <div
                                class="w-14 h-14 flex items-center justify-center bg-neutral-200/60 rounded-full text-neutral-700">
                                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <line x1="80" y1="40" x2="80" y2="88"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="16" />
                                    <line x1="80" y1="128" x2="80" y2="224"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="16" />
                                    <path d="M208,168H152s0-104,56-128V224" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    <path d="M48,40,40,88a40,40,0,0,0,80,0l-8-48" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-4xl font-bold">
                                {{ $totalMenus }} Menus
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-lg shadow-neutral-200">
            <h3 class="text-lg font-semibold">Total Revenue per Month</h3>
            <canvas id="totalRevenue" class="w-full max-h-80"></canvas>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-lg shadow-neutral-200 ">
            <div class=" flex items-start flex-wrap">
                <div class="w-1/3">
                    <ul class="mt-4 space-y-4">
                        <h3 class="text-lg font-semibold">Favorite Menus</h3>
                        @foreach ($favoriteMenus as $menu)
                            <li class="flex items-center">
                                <span class="inline-block w-2.5 h-2.5 mr-2 rounded-full"
                                    style="background-color: {{ $loop->index < 5 ? $colors[$loop->index] : '#999' }}"></span>
                                <div>
                                    <p class="font-medium capitalize">{{ $menu['name'] }} <span
                                            class="text-sm text-gray-500">({{ number_format(($menu['count'] / $totalFavoriteMenus) * 100, 1) }}%)</span>
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $menu['count'] }} sold</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="w-2/3">
                    <canvas id="favoriteMenus" class="w-full max-h-80"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', function() {
            const reservationsCtx = document.getElementById('totalReservations');
            if (reservationsCtx) {
                const reservationsData = @json(array_values($totalReservationsByMonth));
                const reservationLabels = @json(array_keys($totalReservationsByMonth));

                new Chart(reservationsCtx, {
                    type: 'bar',
                    data: {
                        labels: reservationLabels,
                        datasets: [{
                            label: 'Total Reservations',
                            data: reservationsData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            borderRadius: 20
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#000',
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)',
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#000',
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)',
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#000',
                                }
                            }
                        }
                    }
                });
            }

            const revenueCtx = document.getElementById('totalRevenue');
            if (revenueCtx) {
                const revenueData = @json(array_values($totalRevenueByMonth));
                const revenueLabels = @json(array_keys($totalRevenueByMonth));

                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: revenueLabels,
                        datasets: [{
                            label: 'Total Revenue',
                            data: revenueData,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2,
                            fill: false,
                            pointStyle: 'circle',
                            pointRadius: 6,
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#000',
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)',
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#000',
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)',
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#000',
                                }
                            }
                        }
                    }
                });
            }

            const favoriteCtx = document.getElementById('favoriteMenus');
            if (favoriteCtx) {
                const favoriteLabels = @json($favoriteMenuLabels);
                const favoriteData = @json($favoriteMenuData);

                new Chart(favoriteCtx, {
                    type: 'doughnut',
                    data: {
                        labels: favoriteLabels,
                        datasets: [{
                            data: favoriteData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: false,
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
