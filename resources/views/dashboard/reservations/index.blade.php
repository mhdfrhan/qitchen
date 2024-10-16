<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-alert />
    <section>
        <livewire:dashboard.reservations.index>
    </section>
</x-app-layout>
