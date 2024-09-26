<div class="p-6">
    @empty($cartItems->count())
        <p class="text-center">Opss your cart is empty, <a href="{{ route('menu') }}" wire:navigate class="underline">add
                something</a></p>
    @else
        <div class="flex flex-wrap justify-center -mx-4 gap-y-6 xl:gap-y-4 xl:block xl:mx-0">
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
                                <p class="text-textColor/70 text-sm leading-relaxed line-clamp-2">
                                    Rp. {{ number_format($cart->menu->price) }}
                                </p>
                                <div class="flex items-center gap-3 mt-4">
                                    <button wire:click='decrement({{ $cart->id }})'
                                        class="flex items-center justify-center w-8 h-8 border rounded border-borderColor">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                            <rect width="256" height="256" fill="none" />
                                            <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </button>
                                    <p class="text-textColor/70 text-sm leading-relaxed line-clamp-2">
                                        x{{ $cart->quantity }}
                                    </p>
                                    <button wire:click='increment({{ $cart->id }})'
                                        class="flex items-center justify-center w-8 h-8 border rounded border-borderColor">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                            <rect width="256" height="256" fill="none" />
                                            <line x1="40" y1="128" x2="216" y2="128" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                            <line x1="128" y1="40" x2="128" y2="216" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div
            class="flex {{ $carts->discounts && $carts->discount_id != null ? 'items-start' : 'items-center' }} gap-3 mt-8 max-w-xs mx-auto">
            <div>
                <x-text-input wire:model="coupon"
                    class="w-full {{ $carts->discounts && $carts->discount_id != null ? 'border-green-500 !text-green-300' : '' }}"
                    placeholder="{{ $carts->discounts && $carts->discount_id != null ? '' : 'Enter your coupon' }}"
                    type="text" :disabled="$carts->discounts && $carts->discount_id != null" />

                @if ($carts->discounts && $carts->discount_id != null)
                    <p class="text-green-500 mt-4 text-xs">A discount of
                        {{ $carts->discounts && $carts->discount_id != null ? $carts->discounts->discount_amount : '' }}%
                        was successfully
                        applied</p>
                @endif
            </div>

            <button type="button" wire:click="applyCoupon" @if ($carts->discounts && $carts->discount_id != null) disabled @endif
                class="flex items-center justify-center w-9 h-9 border rounded-md  shrink-0 {{ $carts->discounts && $carts->discount_id != null ? 'border-green-500' : 'border-borderColor' }}">

                @if ($carts->discounts && $carts->discount_id != null)
                    <svg class="size-4 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <polyline points="40 144 96 200 224 72" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="16" />
                    </svg>
                @else
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <line x1="40" y1="128" x2="216" y2="128" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <line x1="128" y1="40" x2="128" y2="216" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                @endif
            </button>
        </div>
        <div class="mt-12">
            <h1 class="text-3xl font-forum uppercase font-bold text-center">Total Summary</h1>
            <div class="mt-8">
                <div>
                    @if (Auth::user()->loyalty_points > 0)
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-textColor/70">Points</p>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" wire:model.live='usePoints'>
                                <div
                                    class="relative w-11 h-6 bg-neutral-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-green-800 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-black after:border-neutral-800 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:bg-green-800 peer-checked:bg-green-200">
                                </div>
                                <span
                                    class="ms-3 text-sm font-medium text-textColor/70">{{ number_format(Auth::user()->loyalty_points) }}</span>
                            </label>
                        </div>
                    @endif
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
                    <div class="flex items-center justify-between">
                        <p class="text-textColor/70">Total </p>
                        <p class="text-textColor/70">Rp. {{ number_format($carts->total_amount - $carts->used_points) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('reservation') }}" wire:navigate>
                    <x-primary-button class="w-full">Continue to reservation</x-primary-button>
                </a>
            </div>
        </div>
    @endempty
</div>
