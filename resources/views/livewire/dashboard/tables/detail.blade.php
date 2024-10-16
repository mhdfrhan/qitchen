<div class="p-6">
    @if ($table)
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-medium text-light">
                    Reservation today at table {{ $table->table_number }}
                    {{ $reservations->count() > 0 ? '(' . $reservations->count() . ')' : '' }}
                </h2>
                <p class="mt-1 text-sm text-textColor/60">
                    This is information about table {{ $table->table_number }}
                </p>
                <p class="mt-1 text-sm text-textColor/60">
                    Maksimum guest count is {{ $table->capacity }}
                </p>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-textColor/70">Active</p>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" {{ $table->status ? 'checked' : '' }} class="sr-only peer"
                            wire:model.live='is_active'>
                        <div
                            class="relative w-11 h-6 bg-neutral-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-green-800 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-black after:border-neutral-800 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:bg-green-800 peer-checked:bg-green-200">
                        </div>
                    </label>
                </div>
            </div>
        </div>
    @endif

    @if ($reservations->isEmpty())
        <p class="mt-4 text-sm text-red-500 ">No reservations today.</p>
    @else
        <div class="w-full overflow-x-auto max-h-[600px] overflow-y-auto">
            <div class="mt-4">
                <table class="min-w-full border border-borderColor rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">Name
                            </th>
                            <th class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">Date
                                Time</th>
                            <th class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">Guest
                                Count</th>
                            <th class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">Total
                                Amount</th>
                            <th class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">
                                    {{ $reservation->user->name }}</td>
                                <td class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">
                                    {{ $reservation->reservation_date->format('d M Y') }} -
                                    {{ $reservation->reservation_time->format('H:i') }}
                                </td>
                                <td class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">
                                    {{ $reservation->guest_count }}</td>
                                <td class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">
                                    {{ number_format($reservation->total_amount, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-borderColor text-sm text-neutral-400 text-left">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="bg-neutral-900 border-t py-3 mt-3 border-neutral-800 text-textColor/70">
        <div class="flex justify-end">
            <form wire:submit.prevent='updateCapacity'>
                <x-text-input class="w-14 text-center mr-3" wire:model='capacity' />
                <x-primary-button type="submit">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <polyline points="40 144 96 200 224 72" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                </x-primary-button>
            </form>
        </div>
        <x-action-message class="text-right !text-textColor/70" on="capacity-updated">
            {{ __('Saved.') }}
        </x-action-message>
    </div>
</div>
