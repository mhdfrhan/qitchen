<?php

namespace App\Livewire\Dashboard\Kitchen;

use Livewire\Component;

class ChangeStatus extends Component
{
    public $reservation, $status;

    public function mount()
    {
        $this->status = $this->reservation->status;    
    }

    public function changeStatus()
    {
        if ($this->status == 'finished') {
            $this->reservation->update([
                'status' => 'finished'
            ]);
        } else {
            $this->reservation->update([
                'status' => 'confirmed'
            ]);
        }

        return $this->redirect(route('kitchen'), navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard.kitchen.change-status');
    }
}
