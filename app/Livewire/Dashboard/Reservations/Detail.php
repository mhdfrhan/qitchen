<?php

namespace App\Livewire\Dashboard\Reservations;

use App\Models\Reservations;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    #[Locked]
    public $reservationCode;

    public $reservation;
    public $reservationItems;
    public $amount;
    public $pay;
    public $change;
    public $status;

    protected $rules = [
        'pay' => 'required|numeric',
        'change' => 'required|numeric',
    ];

    public function mount($reservationCode)
    {
        $this->reservationCode = $reservationCode;
        $this->loadReservation();
    }

    public function updatedPay()
    {
        $this->change = (int)$this->pay - (int)$this->amount;
    }

    public function payManual()
    {
        $this->validate();

        $pay = round(floatval($this->pay), 2);
        $amount = round(floatval($this->amount), 2);

        if ($pay < $amount) {
            $this->dispatch('notify', message: 'Insufficient payment', type: 'error');
            return;
        }

        $this->reservation->update([
            'payment_option' => 100,
            'total_amount' => $this->reservation->total_amount + $pay,
            'status' => 'confirmed',
        ]);

        $this->status = 'confirmed';
        $this->loadReservation();
        $this->dispatch('notify', message: 'Payment successful', type: 'success');
        $this->dispatch('status-updated');
    }

    public function loadReservationItems()
    {
        $this->reservationItems = $this->reservation->details()->latest()->get();
        $this->amount =$this->reservation->total_amount + 0.5;
    }

    public function loadReservation()
    {
        $this->reservation = Reservations::where('reservation_code', $this->reservationCode)->first();

        if (!$this->reservation) {
            $this->dispatch('notify', message: 'Oops, something went wrong', type: 'error');
            $this->dispatch('close-modal', 'reservation-detail');
            return;
        }

        $this->status = $this->reservation->status;
        $this->loadReservationItems();
    }

    public function updateStatus()
    {
        $this->reservation->update([
            'status' => $this->status,
        ]);

        $this->dispatch('status-updated');
        $this->dispatch('notify', message: 'Status updated successfully', type: 'success');
        $this->dispatch('close-modal', 'reservation-detail');
    }

    #[On('reservation-selected')]
    public function onReservationSelected($reservationCode)
    {
        $this->reservationCode = $reservationCode;
        $this->loadReservation();
    }

    public function render()
    {
        return view('livewire.dashboard.reservations.detail');
    }
}
