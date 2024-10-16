<?php

namespace App\Livewire\Home\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class CheckPhone extends Component
{
    #[On('phoneAdded')]
    public function render()
    {
        return view('livewire.home.dashboard.check-phone');
    }
}
