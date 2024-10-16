<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-alert />
    <div class="mb-8">
    </div>
    <livewire:dashboard.reservations.index />
</x-app-layout>
