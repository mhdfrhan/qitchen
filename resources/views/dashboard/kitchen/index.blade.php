<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="mb-8">
    </div>
    <div class="p-6 bg-white rounded-2xl">
        <div class=" mb-4">
            <h3 class="text-lg font-semibold">Today Reservations</h3>
            <p class="text-neutral-500">Click table number for more information</p>
        </div>
        <livewire:dashboard.kitchen.index />
    </div>
</x-app-layout>
