<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Reservations;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chart extends Component
{
    public $reservationsByMonth = [];
    public $reservationCountByMonth = [];

    public function mount()
    {
        $this->reservationsByMonth = Reservations::query()
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', ['waiting', 'confirmed'])
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($reservation) {
                return Carbon::parse($reservation->created_at)->format('F');
            })
            ->map(function ($reservations) {
                return $reservations->sum('total_amount');
            })
            ->toArray();

        $this->reservationCountByMonth = Reservations::query()
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', ['waiting', 'confirmed'])
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($reservation) {
                return Carbon::parse($reservation->created_at)->format('F');
            })
            ->map(function ($reservations) {
                return $reservations->count();
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.home.dashboard.chart', [
            'reservationsByMonth' => $this->reservationsByMonth,
            'reservationCountByMonth' => $this->reservationCountByMonth,
        ]);
    }
}
