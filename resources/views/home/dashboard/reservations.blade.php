<x-home-dashboard-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <h3 class="text-lg font-semibold">My Reservations</h3>
        <p class="text-textColor/50 text-sm">Click on the reservation to see detail</p>
        <div class="mt-4">
            <div class="w-full overflow-x-auto">
                <livewire:home.dashboard.reservation>
            </div>
        </div>
    </section>
</x-home-dashboard-layout>
