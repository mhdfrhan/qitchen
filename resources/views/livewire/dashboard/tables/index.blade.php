<div>
    <div class="flex items-start gap-4 xl:gap-8">
        <div class="max-w-40">
            @foreach ($floor as $item)
                <button wire:click="setFloor({{ $item->floor }})"
                    class="w-10 h-10 border rounded-lg flex items-center justify-center mb-3 last:mb-0 border-neutral-200 
                    {{ $item->floor == $selectedFloor ? 'bg-black text-light' : 'bg-neutral-300' }}">
                    {{ $item->floor }}
                </button>
            @endforeach
        </div>
        <div class="w-full">
            <div class="grid sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach ($tables as $i => $table)
                    <button wire:key='table-{{ $i }}'
                        class="w-full h-20 rounded-xl duration-300
        @if ($table->status == 0) bg-red-300 text-red-800
        @elseif (in_array($table->id, $reservedTableIds))
            bg-green-300 hover:bg-green-500 hover:text-white
        @else
            bg-neutral-300 hover:bg-black hover:text-light @endif"
                        wire:click='selectTable({{ $table->id }})'>
                        {{ $table->table_number }}
                        @if ($table->status == 0)
                            <div class="block text-sm mt-1 text-red-800">Inactive</div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <x-modal name="table-detail" :show="$errors->isNotEmpty()" max-width="4xl" focusable>
        @if ($selectedTableId)
            <livewire:dashboard.tables.detail :table-id="$selectedTableId" :key="$selectedTableId" />
        @endif
    </x-modal>
</div>
