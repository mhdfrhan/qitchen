<x-home-dashboard-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <div class="mb-4 mt-6">
            <x-application-logo class="w-36 mx-auto" />
        </div>
        <div class="text-center">
            <h3 class="text-lg font-semibold">Reservation
                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') }} at
                {{ date('H:i', strtotime($reservation->reservation_time)) }}</h3>
            <h4 class="mt-2">Name:
                {{ ucwords($reservation->user->name) . ', Table: ' . $reservation->table->table_number . ', (' . $reservation->guest_count . ' Person)' }}
            </h4>
        </div>
        <div>
            <livewire:home.dashboard.reservation-detail :reservation="$reservation">
        </div>
    </section>
</x-home-dashboard-layout>
