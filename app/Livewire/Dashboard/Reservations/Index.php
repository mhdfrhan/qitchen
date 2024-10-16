<?php

namespace App\Livewire\Dashboard\Reservations;

use App\Models\Reservations;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $filterStatus = 'all';
    public $filterDate;
    public $isDashboard = false;
    public $selectedReservationId = null;

    public function mount()
    {
        $this->isDashboard = request()->routeIs('dashboard');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selectedReservationId = null;
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
        $this->selectedReservationId = null;
    }

    public function updatingFilterDate()
    {
        $this->resetPage();
        $this->selectedReservationId = null;
    }

    public function selectReservation($reservationCode)
    {
        $reservation = $this->getReservationQuery()->where('reservation_code', $reservationCode)->first();
        if ($reservation) {
            $this->selectedReservationId = $reservation->reservation_code;
            $this->dispatch('set-reservation-id', ['id' => $this->selectedReservationId]);
            $this->dispatch('open-modal', 'reservation-detail');
        }
    }

    protected function getReservationQuery()
    {
        $today = now()->toDateString();

        $query = Reservations::with('user')
            ->whereNotIn('status', ['pending', 'canceled']);

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterDate) {
            $query->where('reservation_date', $this->filterDate);
        }

        return $query->orderByRaw("
            CASE
                WHEN status = 'waiting' AND reservation_date = '$today' THEN 1
                WHEN status = 'confirmed' AND reservation_date = '$today' THEN 2
                WHEN status = 'waiting' THEN 3
                WHEN status = 'confirmed' THEN 4
                WHEN status = 'finished' THEN 5
                ELSE 6
            END
        ")
            ->orderBy('reservation_date', 'asc')
            ->orderBy('reservation_time', 'asc');
    }

    #[On('status-updated')]
    public function render()
    {
        $query = $this->getReservationQuery();

        if (!$this->isDashboard) {
            $reservations = $query->paginate(35)->withQueryString();
        } else {
            $reservations = $query->take(10)->get();
        }

        return view('livewire.dashboard.reservations.index', [
            'reservations' => $reservations
        ]);
    }
}
