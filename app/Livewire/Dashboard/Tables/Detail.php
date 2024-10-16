<?php

namespace App\Livewire\Dashboard\Tables;

use App\Models\Meja;
use App\Models\Reservations;
use Livewire\Component;
use Carbon\Carbon;

class Detail extends Component
{
    public $tableId, $table, $reservations = [], $is_active, $capacity;

    public function mount($tableId)
    {
        $this->tableId = $tableId;

        $table = Meja::find($this->tableId);
        if ($table) {
            $this->table = $table;
        }

        $this->capacity = $this->table->capacity;

        $this->is_active = $this->table->status;

        $this->reservations = Reservations::where('table_id', $this->tableId)
            ->whereNot('status', ['pending', 'canceled', 'finished'])
            ->whereDate('reservation_date', Carbon::today())
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->get();
    }

    public function updateCapacity()
    {
        $this->table->capacity = $this->capacity;
        $this->dispatch('capacity-updated');
        $this->table->save();
    }

    public function updatedIsActive()
    {
        $this->table->status = $this->is_active;
        $this->table->save();

        $this->dispatch('tableStatusUpdated');
    }

    public function render()
    {
        return view('livewire.dashboard.tables.detail');
    }
}
