<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <livewire:dashboard.reports :title="$title" />

</x-app-layout>
