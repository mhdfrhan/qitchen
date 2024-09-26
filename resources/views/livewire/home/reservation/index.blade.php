<div class="mt-12">
    <form wire:submit.prevent='submit'>
        <div class="mb-8">
            <h3 class="text-xl font-semibold">Date and Time</h3>
            <div class="mt-3">
                <div class="flex flex-wrap items-center gap-3">
                    <div>
                        <x-input-label for="date">Tanggal</x-input-label>
                        <x-text-input type="date" id="date" wire:model.live="date" class="text-light"
                            min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 month')) }}" />
                    </div>
                    <div>
                        <x-input-label for="time">Time</x-input-label>
                        <x-text-input type="time" id="time" wire:model.live="time" class="text-light"
                            step="60" min="09:00" max="21:00" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h3 class="text-xl font-semibold">Number of People</h3>
            <div class="mt-3">
                <div class="w-full flex items-center gap-2">
                    <x-text-input class="w-20" type="number" wire:model.live="peoples" required
                        onkeydown="if(event.key==='.'){event.preventDefault();}"
                        oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" />
                    <x-primary-button type="button" wire:click="addPeople">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none" />
                            <polyline points="40 144 96 200 224 72" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="24" />
                        </svg>
                    </x-primary-button>
                </div>
            </div>
        </div>
        @if ($numberpeople > 0 && $numberpeople <= 10)
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Choose a Table</h3>
                <div class="mt-3">
                    <div class="w-full">
                        <div class="mb-8">
                            <p class="text-textColor/70 mb-2">Floor</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($floors as $floor)
                                    <button type="button" wire:click="setFloor({{ $floor->floor }})"
                                        class="py-2 px-4 border border-borderColor rounded-lg text-center duration-200 {{ $floor->floor == $this->floor ? 'bg-light text-black' : 'bg-neutral-900 hover:bg-neutral-800 text-white' }}">
                                        {{ $floor->floor }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 xl:grid-cols-6 gap-4">
                            @foreach ($tables as $table)
                                <label class="relative">
                                    <input type="radio" wire:model.live="selectedTable" value="{{ $table->id }}"
                                        class="sr-only peer" @if (in_array($table->id, $reservedTables)) disabled @endif>
                                    <div
                                        class="w-full h-16 cursor-pointer flex justify-center items-center border rounded-xl text-center duration-300
                                    {{ $selectedTable == $table->id ? '!bg-light !text-black' : '' }}
                                    {{ in_array($table->id, $reservedTables) ? 'bg-red-400 text-red-900 border-red-400 !cursor-not-allowed' : 'bg-neutral-900 hover:bg-neutral-800 text-white border-borderColor' }}">
                                        {{ $table->table_number }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($numberpeople > 10)
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Table</h3>
                <div class="mt-3">
                    <div class="w-full">
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 xl:grid-cols-6 gap-4">
                            @foreach ($tableVip as $table)
                                <label class="relative">
                                    <input type="radio" wire:model.live="selectedTable" value="{{ $table->id }}"
                                        class="sr-only peer" @if (in_array($table->id, $reservedTables)) disabled @endif>
                                    <div
                                        class="w-full h-16 cursor-pointer flex justify-center items-center border rounded-xl text-center duration-300
                                    {{ $selectedTable == $table->id ? 'bg-light text-black' : '' }}
                                    {{ in_array($table->id, $reservedTables) ? 'bg-red-400 text-red-900 border-red-400 !cursor-not-allowed' : 'bg-neutral-900 hover:bg-neutral-800 text-white border-borderColor' }}">
                                        {{ $table->table_number }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if ($selectedTable)
                    <p class="mt-2">This table maximum limit {{ $limitVipTable }} people</p>
                @endif
            </div>
        @endif

        @if ($selectedTable)
            <div class="mt-8">
                <div class="inline-flex items-center gap-2 ">
                    <label for="preOrder" class="text-xl font-semibold cursor-pointer">Pre Order</label>
                    <div>
                        <input type="checkbox"
                            class="rounded border-borderColor text-[#948968] shadow-sm focus:ring-light duration-300 cursor-pointer"
                            {{ $existingReservation && $existingReservation->is_preorder ? 'checked' : '' }}
                            wire:model.live="preOrder" id="preOrder">
                    </div>
                </div>
                <p class="text-textColor/70">Pre Order will serve the food before you arrive (pay 100%)</p>
            </div>
            @if (!$preOrder)
                <div class="mt-8">
                    <h3 class="text-xl font-semibold">Payment Option</h3>
                    <div class="mt-3">
                        <div class="flex gap-4">
                            <label>
                                <input type="radio" wire:model.live="paymentOption" value="50" id="paymentOption"
                                    class="mr-2 checked:text-[#948968]"> Pay 50%
                            </label>
                            <label>
                                <input type="radio" wire:model.live="paymentOption" value="100" id="paymentOption"
                                    class="mr-2 checked:text-[#948968]"> Pay
                                100%
                            </label>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <div class="mt-8">
            <x-primary-button type="submit" class="w-full">
                {{ $existingReservation ? 'Update Reservation' : 'Create Reservation' }}
            </x-primary-button>
        </div>
    </form>
</div>
