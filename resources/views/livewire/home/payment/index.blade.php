<div class="mt-12">
    <div class="mb-4 text-center">
        <h3 class="text-xl font-semibold">Menu</h3>
    </div>
    <div class="flex flex-wrap -mx-4 gap-y-6 xl:gap-y-4 xl:block xl:mx-0">
        @foreach ($cartItems as $cart)
            <div class="w-full sm:w-1/2 px-4 xl:px-0 xl:block xl:w-full mb-8 last:mb-0">
                <div
                    class="border border-borderColor xl:border-0 p-3 xl:p-0 rounded-xl duration-300 ease-in-out relative group">
                    <div class="flex flex-wrap items-center -mx-4">
                        <div class="w-full xl:w-1/3 px-4">
                            <div class="w-full mb-4 xl:mb-0">
                                <img src="{{ asset($cart->menu->image) }}" alt="{{ $cart->menu->name }}"
                                    class="rounded-lg w-full">
                            </div>
                        </div>
                        <div class="w-full xl:w-2/3 px-4">
                            <div
                                class="mb-3 flex items-end flex-none gap-4 flex-row h-min justify-start overflow-visible p-0 relative w-full">
                                <h3 class="text-xl font-medium font-forum uppercase shrink-0 leading-none">
                                    {{ $cart->menu->name }}</h3>
                                <div class="border-b w-full border-dashed border-borderColor"></div>
                                <div class="shrink-0">
                                    <p class="text-lg font-medium font-forum leading-none">Rp.
                                        {{ number_format($cart->price) }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-textColor/70 text-sm leading-relaxed line-clamp-2 text-left">
                                    Rp. {{ number_format($cart->menu->price) }}
                                </p>
                                <p class="text-textColor/70 text-sm leading-relaxed line-clamp-2 text-left">
                                    x{{ $cart->quantity }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        <div class="mb-4 text-center">
            <h3 class="text-xl font-semibold">Reservation</h3>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Name</p>
                <p class="text-textColor/70 capitalize">{{ $carts->user->name }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Email</p>
                <p class="text-textColor/70">{{ $carts->user->email }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Phone</p>
                <p class="text-textColor/70">{{ $carts->user->phone }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Table No</p>
                <p class="text-textColor/70">{{ $reservation->table->table_number }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Reservation Time</p>
                <p class="text-textColor/70">
                    {{ date('d F Y', strtotime($reservation->reservation_date)) . ' ' . date('H:i', strtotime($reservation->reservation_time)) }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Guest Count</p>
                <p class="text-textColor/70">{{ $reservation->guest_count }} Person</p>
            </div>
            <div class="flex items-center justify-between ">
                <p class="text-green-500">Loyalty Points</p>
                <p class="text-green-500 inline-flex items-center gap-1 font-semibold">
                    + Rp. {{ number_format($pointsToAdd) }}
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <ellipse cx="96" cy="84" rx="80" ry="36" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M16,84v40c0,19.88,35.82,36,80,36s80-16.12,80-36V84" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="64" y1="117" x2="64" y2="157" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path
                            d="M176,96.72c36.52,3.34,64,17.86,64,35.28,0,19.88-35.82,36-80,36-19.6,0-37.56-3.17-51.47-8.44"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="16" />
                        <path d="M80,159.28V172c0,19.88,35.82,36,80,36s80-16.12,80-36V132" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="192" y1="165" x2="192" y2="205" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="128" y1="117" x2="128" y2="205" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                </p>
            </div>
        </div>
    </div>
    <div class="mt-8">
        @if ($reservation->payment_option == 50)
            <div
                class="w-full bg-orange-300 text-orange-800 text-center px-3 py-2 rounded-lg mb-3 font-semibold text-sm">
                <p>50% Down Payment</p>
            </div>
        @endif
        <div class="border border-borderColor rounded-xl p-4">
            <div class="flex items-center justify-between">
                <p class="text-textColor/70">Subtotal</p>
                <p class="text-textColor/70">Rp. {{ number_format($cartItems->sum('price')) }}</p>
            </div>
            <div class="flex items-center justify-between my-4">
                <p class="text-textColor/70">Discount</p>
                <p class="text-textColor/70">Rp.
                    {{ number_format($carts->discounts && $carts->discount_id != null ? $carts->discounts->discount_amount : 0) }}%
                </p>
            </div>
            <div class="flex items-center justify-between mb-4">
                <p class="text-textColor/70">Tax </p>
                <p class="text-textColor/70">Rp. {{ number_format($carts->total_amount * 0.11) }}</p>
            </div>
            @if ($carts->used_points > 0)
                <div class="flex items-center justify-between mb-4">
                    <p class="text-textColor/70">Points </p>
                    <p class="text-textColor/70">-Rp. {{ number_format($carts->used_points) }}</p>
                </div>
            @endif
            @if ($reservation->payment_option == 50)
                <div class="flex items-center justify-between">
                    <p class="text-textColor/70">Total </p>
                    <p class="text-textColor/70">Rp.
                        {{ number_format($carts->total_amount * 0.5 + $carts->total_amount * 0.5 * 0.11) }} (50%)
                    </p>
                </div>
            @else
                <div class="flex items-center justify-between">
                    <p class="text-textColor/70">Total </p>
                    <p class="text-textColor/70">Rp.
                        {{ number_format($reservation->total_amount) }}
                    </p>
                </div>
            @endif
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full" id="pay-button">Pay now</x-primary-button>
        </div>
    </div>

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
                            @this.navigate('home.dashboard');
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
</div>
