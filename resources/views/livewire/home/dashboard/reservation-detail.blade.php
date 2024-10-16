<div>
    <x-alert />

    <div class="mt-4 text-center">
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
    </div>

    <div class="mt-8">
        @if ($reservation->status == 'pending')
            <div class="flex items-center gap-3 justify-end mb-4">
                <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'cancel-reservation-modal')">Cancel</x-danger-button>
                <x-primary-button id="pay-button">Pay Now</x-primary-button>
            </div>

            <x-modal name="cancel-reservation-modal" :show="$errors->isNotEmpty()" max-width="lg">
                <div class="p-6">
                    <div class=" flex justify-end">
                        <div>
                            <div class="w-8 h-8 inline-flex items-center justify-center rounded-full text-neutral-400 hover:text-light hover:bg-neutral-700/80 duration-300 cursor-pointer"
                                x-on:click="$dispatch('close')">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none" />
                                    <line x1="200" y1="56" x2="56" y2="200"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                    <line x1="200" y1="200" x2="56" y2="56"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="16" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <svg class="size-28 text-red-500 fill-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor"
                                stroke-miterlimit="10" stroke-width="16" />
                            <line x1="128" y1="136" x2="128" y2="80" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="16" />
                            <circle cx="128" cy="172" r="12" />
                        </svg>

                        <h2 class="text-2xl mt-2 font-medium text-light">
                            {{ __('Cancel Reservation at ' . date('d M Y', strtotime($reservation->reservation_date))) }}
                        </h2>

                        <p class="mt-1 text-sm text-neutral-400">
                            {{ __('Are you sure you want to cancel this reservation?') }}
                        </p>
                        <x-danger-button class="mt-6 mb-4" wire:click='cancelReservation'
                            x-on:click="$dispatch('close')">
                            Cancel Reservation
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @endif
        <div class="w-full overflow-x-auto">
            <div class="min-w-max w-full">
                <table class="w-full">
                    <thead class="uppercase font-bold border border-borderColor">
                        <tr>
                            <th class="py-3 px-4 text-left">Image</th>
                            <th class="py-3 px-4 text-left">Menu</th>
                            <th class="py-3 px-4 text-left">Quantity</th>
                            <th class="py-3 px-4 text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservation->details as $detail)
                            <tr class="border border-borderColor">
                                <td class="py-3 px-4 text-left">
                                    <img src="{{ asset($detail->menu->image) }}" alt="{{ $detail->menu->name }}"
                                        class="w-24 rounded-lg" loading="lazy">
                                </td>
                                <td class="py-3 px-4 text-left capitalize">{{ $detail->menu->name }}</td>
                                <td class="py-3 px-4 text-left">{{ $detail->quantity }}</td>
                                <td class="py-3 px-4 text-left">Rp. {{ number_format($detail->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-6 flex justify-end">
        <div class="w-full  sm:w-1/2">
            @if ($reservation->payment_option == 50)
                <div
                    class="w-full bg-orange-300 text-orange-800 text-center px-3 py-2 rounded-lg mb-3 font-semibold text-sm">
                    <p>50% Down Payment</p>
                </div>
            @endif
            <table class="w-full">
                <tr>
                    <td class="py-2 text-left">Subtotal</td>
                    <td class="py-2 text-center">:</td>
                    <td class="py-2 text-right">Rp. {{ number_format($reservation->details->sum('price')) }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-left">Discount</td>
                    <td class="py-2 text-center">:</td>
                    <td class="py-2 text-right">
                        {{ number_format($reservation->discounts && $reservation->discount_id != null ? $reservation->discounts->discount_amount : 0) }}%
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-left">Tax</td>
                    <td class="py-2 text-center">:</td>
                    <td class="py-2 text-right">Rp.
                        {{ number_format($reservation->details->sum('price') * 0.11) }}</td>
                </tr>
                @if ($reservation->used_points > 0)
                    <tr>
                        <td class="py-2 text-left">Points</td>
                        <td class="py-2 text-center">:</td>
                        <td class="py-2 text-right">-Rp. {{ number_format($reservation->used_points) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="py-2 text-left">Total</td>
                    <td class="py-2 text-center">:</td>
                    <td class="py-2 text-right">Rp. {{ number_format($reservation->total_amount) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="mt-6">
        <div class="w-32 ml-auto border p-3 border-borderColor rounded-lg">
            {!! DNS2D::getBarcodeSVG($reservation->reservation_code, 'QRCODE', 3.6, 3.6, 'white') !!}
        </div>
    </div>

    @if ($reservation->status == 'pending')
        @push('scripts')
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
            </script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function() {
                    // SnapToken acquired from previous step
                    snap.pay('{{ $snapToken }}', {
                        // Optional
                        onSuccess: function(result) {
                            @this.dispatch('payment-success');

                            setTimeout(() => {
                                @this.navigate('reservation.detail');
                            }, 4000);
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                };
            </script>
        @endpush
    @endif
</div>
