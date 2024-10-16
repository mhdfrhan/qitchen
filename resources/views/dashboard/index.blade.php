<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="mb-8">
        <livewire:dashboard.chart>
    </div>
    <div class="p-6 bg-white rounded-2xl">
        <h3 class="text-lg font-semibold mb-4">Recent Reservations</h3>
        <livewire:dashboard.reservations.index>
    </div>
</x-app-layout>
