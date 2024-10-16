<?php

namespace App\Livewire\Dashboard\Kitchen;

use App\Models\Reservations;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $todayReservations = [];

    public function mount()
    {
        $this->loadTodayReservations();
    }

    // Method to load today's reservations
    public function loadTodayReservations()
    {
        $today = Carbon::today();

        // Query reservations for today
        $this->todayReservations = Reservations::whereDate('reservation_date', $today)
            ->where('status', 'confirmed')
            ->orderBy('reservation_date')
            ->get();
    }

    public function redirectToReservation($reservation_code) {
        $this->redirect(route('kitchen.reservation.detail', $reservation_code), navigate: true);
    }

    public function render()
    {
        $this->loadTodayReservations();
        return view('livewire.dashboard.kitchen.index', [
            'reservations' => $this->todayReservations
        ]);
    }
}
