<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-alert />
    <div class="mb-4 text-right max-w-xs ml-auto mt-8">
        <livewire:dashboard.kitchen.change-status :reservation="$reservation" />
    </div>
    <div class="border border-neutral-800 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between gap-3 flex-wrap bg-black text-light p-3 rounded-2xl">
            <h3 class="text-3xl font-semibold">{{ $title }} </h3>
            <p class="text-red-500">
                {{ date('d M Y', strtotime($reservation->reservation_date)) . ' ' . date('H:i', strtotime($reservation->reservation_time)) }}
            </p>
        </div>
        <div class="p-6 ">
            @php
                $groupedMenus = $reservation->details->groupBy('menu.category.name');
            @endphp

            @foreach ($groupedMenus as $category => $items)
                <div class="mb-6 last:mb-0 border-b border-neutral-300 pb-6 last:pb-0 last:border-0">
                    <h2 class="text-2xl font-bold mb-3 last:mb-0">{{ $category }}</h2>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach ($items as $i => $item)
                            <div class="p-6 rounded-xl bg-white shadow-lg shadow-neutral-200 flex items-center justify-between gap-3">
                                <h3 class="text-lg font-semibold">{{ $item->menu->name }}</h3>
                                <p class="text-neutral-500 text-lg">x{{ $item->quantity }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
