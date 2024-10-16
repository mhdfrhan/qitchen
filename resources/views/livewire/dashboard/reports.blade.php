<div>
    <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
        <div>
            <h3 class="text-2xl font-bold">{{ $title }}</h3>
            <p class="text-neutral-500 print:hidden">Page for managing weekly reports</p>
            <p class="text-neutral-500 hidden print:block">Monthly report</p>
        </div>
    </div>

    <div class="flex items-center justify-between flex-wrap gap-3 print:hidden">
        <div class="flex items-end gap-3 flex-wrap">
            <div>
                <x-input-label class="text-neutral-500" for="from-date">From</x-input-label>
                <x-text-input class="!text-black" type="date" id="from-date" wire:model='fromDate' />
            </div>
            <div>
                <x-input-label class="text-neutral-500" for="to-date">To</x-input-label>
                <x-text-input class="!text-black" type="date" id="to-date" wire:model='toDate' />
            </div>
            <div>
                <x-dark-button wire:click='submit'>Generate Report</x-dark-button>
            </div>
        </div>
        <div class="no-print">
            <x-dark-button class="inline-flex items-center gap-2" onclick="window.print()">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <path d="M176,104h24a8,8,0,0,1,8,8v96a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V112a8,8,0,0,1,8-8H80"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="16" />
                    <polyline points="88 64 128 24 168 64" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16" />
                    <line x1="128" y1="24" x2="128" y2="136" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="22" />
                </svg>
                Print
            </x-dark-button>
        </div>
    </div>

    <div class="mt-6">
        <div class="w-full overflow-x-auto">
            <div class="min-w-max w-full">
                @if(count($reports) > 0)
                    <table class="w-full text-left text-sm">
                        <thead class="border border-neutral-300">
                            <tr>
                                <th class="py-3 px-4 text-left">Week</th>
                                <th class="py-3 px-4 text-left">Total Reservations</th>
                                <th class="py-3 px-4 text-left">Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr class="border border-neutral-300">
                                <td class="py-3 px-4">{{ date('d/m/Y', strtotime($report['week_start'])) }} to {{ date('d/m/Y', strtotime($report['week_end'])) }}</td>
                                <td class="py-3 px-4">{{ $report['total_reservations'] }}</td>
                                <td class="py-3 px-4">Rp. {{ number_format($report['total_revenue'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center py-4">No reservations found for the selected date range.</p>
                @endif
            </div>
        </div>
    </div>
</div>