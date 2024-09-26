<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Reservation extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function mount() {}
    public function render()
    {
        $reservations = Reservations::where('user_id', Auth::user()->id)->latest()->paginate(10)->withQueryString()->onEachSide(1);

        return view('livewire.home.dashboard.reservation', [
            'reservations' => $reservations
        ]);
    }

    public function navigateToReservationDetail($id) {
        $this->redirect(route('reservation.detail', $id), navigate: true);
    }
}
