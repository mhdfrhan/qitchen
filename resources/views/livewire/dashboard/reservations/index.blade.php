<div>
    @if (!$isDashboard)
        <div class="mb-8 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h3 class="text-2xl font-bold">Reservations</h3>
                <p class="text-neutral-500">Page for managing customer reservations</p>
            </div>
            <div class="inline-flex flex-wrap items-center gap-3 bg-black text-light py-2 px-4 rounded-lg text-sm mb-4">
                <p>Waiting ({{ $reservations->where('status', 'waiting')->count() }})</p>
                <p>Confirmed ({{ $reservations->where('status', 'confirmed')->count() }})</p>
                <p>Finished ({{ $reservations->where('status', 'finished')->count() }})</p>
                <p>Cancelled ({{ $reservations->where('status', 'cancelled')->count() }})</p>
            </div>
        </div>
    @endif

    <div class="w-full {{ !$isDashboard ? 'bg-white p-6 rounded-2xl shadow-lg shadow-neutral-200' : '' }}">
        @if (!$isDashboard)
            <div class="flex flex-wrap gap-3 justify-between mb-6">
                <div class="w-full max-w-xs">
                    <x-text-input wire:model.live="search"
                        class="w-full border-neutral-200 focus:border-black !text-black" placeholder="Search..." />
                </div>
                <div class="flex items-center gap-3">
                    <div>
                        <x-select-input wire:model.live='filterStatus'
                            class='w-full border-neutral-300 focus:border-black !text-black'>
                            <option class="bg-black text-light" value="all">All</option>
                            <option class="bg-black text-light" value="waiting">Waiting</option>
                            <option class="bg-black text-light" value="confirmed">Confirmed</option>
                            <option class="bg-black text-light" value="finished">Finished</option>
                            <option class="bg-black text-light" value="cancelled">Cancelled</option>
                        </x-select-input>
                    </div>
                    <div>
                        <x-text-input type="date" wire:model.live="filterDate"
                            class="w-full border-neutral-300 focus:border-black !text-black" />
                    </div>
                </div>
            </div>
        @endif

        <div class="w-full overflow-auto">
            <div class="min-w-max">
                <table class="w-full text-sm text-left">
                    <thead class="uppercase font-bold text-neutral-500">
                        <tr>
                            <th scope="col" class="py-3 px-4 border-b text-center">#</th>
                            <th scope="col" class="py-3 px-4 border-b">Name</th>
                            <th scope="col" class="py-3 px-4 border-b">Table</th>
                            <th scope="col" class="py-3 px-4 border-b">Date Time</th>
                            <th scope="col" class="py-3 px-4 border-b">Person</th>
                            <th scope="col" class="py-3 px-4 border-b">Status</th>
                            <th scope="col" class="py-3 px-4 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.keep-alive>
                        @foreach ($reservations as $i => $reservation)
                            <tr class="hover:bg-neutral-200/70 cursor-pointer border-b last:border-0"
                                wire:key="{{ $reservation->reservation_code }}"
                                wire:click="selectReservation('{{ $reservation->reservation_code }}')">
                                <td class="py-3 px-4 text-center">{{ !$this->isDashboard ? $reservations->firstItem() + $i : $i + 1 }}</td>
                                <td class="py-3 px-4 capitalize font-semibold">{{ $reservation->user->name }}</td>
                                <td class="py-3 px-4">{{ $reservation->table->table_number }}</td>
                                <td class="py-3 px-4">
                                    {{ date('d M Y', strtotime($reservation->reservation_date)) }}
                                    {{ date('H:i', strtotime($reservation->reservation_time)) }}
                                </td>
                                <td class="py-3 px-4">{{ $reservation->guest_count }} Person</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $reservation->status == 'waiting'
                                            ? 'bg-orange-200 text-orange-800'
                                            : ($reservation->status == 'confirmed'
                                                ? 'bg-green-200 text-green-800'
                                                : ($reservation->status == 'cancelled'
                                                    ? 'bg-red-200 text-red-800'
                                                    : ($reservation->status == 'finished'
                                                        ? 'bg-blue-200 text-blue-800'
                                                        : 'bg-gray-200 text-gray-800'))) }}">
                                        {{ $reservation->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">Rp. {{ number_format($reservation->total_amount) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (!$isDashboard)
                    {{ $reservations->links() }}
                @endif
            </div>

            <x-modal name="reservation-detail" :show="$errors->isNotEmpty()" max-width="4xl" focusable>
                @if ($selectedReservationId)
                    <livewire:dashboard.reservations.detail :reservation-code="$selectedReservationId" :key="$selectedReservationId" />
                @endif
            </x-modal>
        </div>
    </div>
</div>
