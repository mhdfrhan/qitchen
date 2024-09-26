<div>
    <section class="flex flex-wrap -mx-4 gap-y-4">
        <div class="w-full xl:w-1/2 px-4">
            <div class="border p-3 bg-neutral-900 border-borderColor rounded-xl">
                <h6 class="font-semibold mb-3">Total Amount</h6>
                <canvas id="reservationsByMonth"></canvas>
            </div>
        </div>

        <div class="w-full xl:w-1/2 px-4">
            <div class="border p-3 bg-neutral-900 border-borderColor rounded-xl">
                <h6 class="font-semibold mb-3">Reservation Count</h6>
                <canvas id="reservationCountByMonth"></canvas>
            </div>
        </div>
    </section>

    @push('scripts')
        <script data-navigate-once>
            document.addEventListener('livewire:navigated', function() {
                const ctx1 = document.getElementById('reservationsByMonth');

                const months = @json(array_keys($reservationsByMonth));

                const backgroundColors = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ];

                const borderColors = [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ];


                if (ctx1) {
                    ctx1.getContext('2d');
                    const reservationsByMonth = @json(array_values($reservationsByMonth));

                    const myChart1 = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Total Amount',
                                data: reservationsByMonth,
                                backgroundColor: backgroundColors,
                                borderColor: borderColors,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: '#ffffff',
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)',
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: '#ffffff',
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)',
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: '#ffffff',
                                    }
                                }
                            }
                        }
                    });
                }



                const ctx2 = document.getElementById('reservationCountByMonth');
                if (ctx2) {
                    ctx2.getContext('2d');
                    const reservationCountByMonth = @json(array_values($reservationCountByMonth));

                    const myChart2 = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Reservation Count',
                                data: reservationCountByMonth,
                                backgroundColor: backgroundColors,
                                borderColor: borderColors,
                                borderWidth: 1,
                                pointStyle: 'circle',
                                pointRadius: 6,
                                pointHoverRadius: 12
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: '#ffffff',
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)',
                                    }
                                },
                                x: {
                                    ticks: {
                                        color: '#ffffff',
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)',
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: '#ffffff',
                                    }
                                }
                            }
                        }
                    });
                }

            });
        </script>
    @endpush

</div>
