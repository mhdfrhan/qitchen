<div class="p-6">
    <div>
        @if ($reservation)
            <div class="w-full">
                <div class="w-full">
                    <h2 class="text-xl font-medium text-light text-center">
                        {{ __('Reservation date: ') }}
                        {{ Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }} {{ __('at ') }}
                        {{ date('H:i', strtotime($reservation->reservation_time)) }}
                    </h2>


                    <p class="mt-1 text-sm text-textColor/60 text-center">
                        {{ __('Guest count: ') }} {{ $reservation->guest_count }} {{ __('Person, ') }}

                    </p>

                    <small class="text-neutral-500 text-center block">id: {{ $reservation->reservation_code }}</small>

                    <div class="flex justify-center">
                        <div class="w-full">
                            <div class="mt-6">
                                <div class="flex justify-between items-center gap-3">
                                    <h2 class="text-lg font-medium text-light">User Information</h2>
                                    <p class="text-textColor/60">{{ __('Status: ') }} <span
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
                                    </p>
                                </div>
                                <table class="w-full mt-2">
                                    <tr>
                                        <td class="text-textColor/60 border py-2 px-3 border-borderColor">Name</td>
                                        <td class="text-light text-right border py-2 px-3 border-borderColor">
                                            {{ $reservation->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-textColor/60 border py-2 px-3 border-borderColor">Email</td>
                                        <td class="text-light text-right border py-2 px-3 border-borderColor">
                                            {{ $reservation->user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-textColor/60 border py-2 px-3 border-borderColor">Phone</td>
                                        <td class="text-light text-right border py-2 px-3 border-borderColor">
                                            {{ $reservation->user->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-textColor/60 border py-2 px-3 border-borderColor">Table</td>
                                        <td class="text-light text-right border py-2 px-3 border-borderColor">
                                            {{ $reservation->table->table_number }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-light">Reservation Items</h2>
                        <div class="w-full mt-2 overflow-x-auto">
                            <div class="min-w-max w-full">
                                <table class="w-full">
                                    <thead class="uppercase font-bold bg-neutral-700">
                                        <tr>
                                            <th class="text-left text-textColor/60 border py-2 px-3 border-borderColor">
                                                Image</th>
                                            <th class="text-left text-textColor/60 border py-2 px-3 border-borderColor">
                                                Menu</th>
                                            <th class="text-left text-textColor/60 border py-2 px-3 border-borderColor">
                                                Price</th>
                                            <th class="text-left text-textColor/60 border py-2 px-3 border-borderColor">
                                                Quantity</th>
                                            <th class="text-left text-textColor/60 border py-2 px-3 border-borderColor">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservationItems as $item)
                                            <tr>
                                                <td class="border py-2 px-3 border-borderColor">
                                                    <img src="{{ asset($item->menu->image) }}"
                                                        alt="{{ $item->menu->name }}" class="w-24 rounded-lg"
                                                        loading="lazy">
                                                </td>
                                                <td
                                                    class="text-left border border-borderColor py-2 px-3 capitalize  text-light">
                                                    <p class="line-clamp-2 max-w-xs">{{ $item->menu->name }}
                                                    </p>
                                                </td>
                                                <td class="border border-borderColor py-2 px-3 text-light">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="border border-borderColor py-2 px-3 text-light">Rp.
                                                    {{ number_format($item->menu->price) }}</td>
                                                <td class="border border-borderColor py-2 px-3 text-light">Rp.
                                                    {{ number_format($item->quantity * $item->menu->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap justify-between-mx-3">
                        <div class="w-full md:w-1/2 md:px-3 mb-3 md:m-0">
                            <div class="w-full">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 text-textColor/60 text-left">Subtotal</td>
                                        <td class="py-2 text-textColor/60 text-center">:</td>
                                        <td class="py-2 text-light font-semibold text-right">Rp.
                                            {{ number_format($reservation->details->sum('price')) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-textColor/60 text-left">Discount</td>
                                        <td class="py-2 text-textColor/60 text-center">:</td>
                                        <td class="py-2 text-light font-semibold text-right">
                                            {{ number_format($reservation->discounts && $reservation->discount_id != null ? $reservation->discounts->discount_amount : 0) }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-textColor/60 text-left">Tax</td>
                                        <td class="py-2 text-textColor/60 text-center">:</td>
                                        <td class="py-2 text-light font-semibold text-right">Rp.
                                            {{ number_format($reservation->details->sum('price') * 0.11) }}</td>
                                    </tr>
                                    @if ($reservation->used_points > 0)
                                        <tr>
                                            <td class="py-2 text-textColor/60 text-left">Points</td>
                                            <td class="py-2 text-textColor/60 text-center">:</td>
                                            <td class="py-2 text-light font-semibold text-right">-Rp.
                                                {{ number_format($reservation->used_points) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="py-2 text-textColor/60 text-left">Total</td>
                                        <td class="py-2 text-textColor/60 text-center">:</td>
                                        <td class="py-2 text-light font-semibold text-right">Rp.
                                            {{ number_format($reservation->total_amount) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @if ($reservation->payment_option == 50)
                            <div class="w-full md:w-1/2 md:px-3">
                                <h2 class="text-lg font-medium text-light">Payment 50% (- Rp. {{ number_format($reservation->total_amount) }})</h2>
                                <form wire:submit.prevent="payManual" class="space-y-3 mt-2">
                                    <div>
                                        <x-input-label for="pay" value="{{ __('Pay') }}" />
                                        <x-text-input wire:model.live="pay" id="pay" name="pay" type="number"
                                            class="mt-1 block w-full" autofocus />
                                    </div>
                                    <div>
                                        <x-input-label for="change" value="{{ __('Changing money') }}" />
                                        <x-text-input wire:model.live="change" id="pay" name="pay"
                                            type="number" disabled
                                            class="mt-1 block w-full bg-neutral-700 cursor-not-allowed" />
                                    </div>
                                    <div class="flex justify-end">
                                        <x-primary-button type="submit"
                                            class="px-6">{{ __('Pay') }}</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="w-full md:w-1/2 md:px-3">
                                <h2 class="text-lg font-medium text-light">Update Status</h2>
                                <div class="mt-3">
                                    <x-select-input name="status" wire:model="status" class="w-full">
                                        <option class="bg-black text-light" value="waiting">Waiting</option>
                                        <option class="bg-black text-light" value="confirmed">Confirmed</option>
                                        <option class="bg-black text-light" value="finished">Finished</option>
                                        <option class="bg-black text-light" value="cancelled">Cancelled</option>
                                    </x-select-input>
                                    <div class="flex justify-end mt-3">
                                        <x-primary-button type="button" wire:click="updateStatus"
                                            class="px-6">{{ __('Update') }}</x-primary-button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="absolute top-4 right-4 z-50">
                    <div class="w-8 h-8 inline-flex items-center justify-center rounded-full text-textColor/60 hover:text-light hover:bg-neutral-700/80 duration-300 cursor-pointer"
                        x-on:click="$dispatch('close')">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <line x1="200" y1="56" x2="56" y2="200" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            <line x1="200" y1="200" x2="56" y2="56" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        </svg>
                    </div>
                </div>
            </div>
        @else
            <p>No reservation data found.</p>
        @endif
    </div>
</div>
