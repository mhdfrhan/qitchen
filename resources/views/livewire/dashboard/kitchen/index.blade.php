<div class="w-full overflow-x-auto mt-8">
    <div class="min-w-max w-full">
        <table class="w-full text-left">
            <thead class="uppercase">
                <tr class="border border-neutral-300">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Table Number</th>
                    <th class="px-4 py-3">Date Time</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody wire:poll.keep-alive>
                @forelse ($reservations as $i => $r)
                    <tr class="border border-neutral-300 hover:bg-neutral-300/70 cursor-pointer"
                        wire:key="{{ $r->reservation_code }}"
                        wire:click='redirectToReservation("{{ $r->reservation_code }}")'>
                        <td class="px-4 py-3">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">{{ $r->table->table_number }}</td>
                        <td class="px-4 py-3">{{ date('d M Y', strtotime($r->reservation_date)) }}
                            {{ date('H:i', strtotime($r->reservation_time)) }}</td>
                        <td class="px-4 py-3">{{ $r->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 pt-5 px-4 text-center text-red-500">No reservations for today.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
