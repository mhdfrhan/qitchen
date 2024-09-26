<div class="min-w-max">
    @empty($reservations->count())
    <div>
        <p class="text-textColor/50">There is no reservation</p>
    </div>
    @else
        <table class="w-full">
            <thead class="uppercase font-bold border border-borderColor">
                <tr>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">Time</th>
                    <th class="py-3 px-4 text-left">Table</th>
                    <th class="py-3 px-4 text-left">Person</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="border border-borderColor hover:bg-neutral-900 cursor-pointer" wire:click="navigateToReservationDetail('{{ $reservation->reservation_code }}')">
                        <td class="py-3 px-4 text-left">{{ date('d M Y', strtotime($reservation->reservation_date)) }}</td>
                        <td class="py-3 px-4 text-left">{{ date('H:i', strtotime($reservation->reservation_time)) }}</td>
                        <td class="py-3 px-4 text-left">{{ $reservation->table->table_number }}</td>
                        <td class="py-3 px-4 text-left">{{ $reservation->guest_count }} Person</td>
                        <td class="py-3 px-4 text-left">Rp.
                            {{ number_format($reservation->total_amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-left">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $reservation->status == 'waiting' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reservation->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reservations->links() }}
    @endempty
</div>
