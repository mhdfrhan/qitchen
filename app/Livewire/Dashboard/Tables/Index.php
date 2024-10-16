<?php

namespace App\Livewire\Dashboard\Tables;

use App\Models\Meja;
use App\Models\Reservation;
use App\Models\Reservations;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $floor, $selectedTableId = null;
    public $tables = [];
    public $selectedFloor = 1;
    public $reservedTableIds = [];

    public function mount()
    {
        $this->loadTables();
    }

    public function setFloor($floor)
    {
        try {
            $this->floor = $floor;
            $this->selectedFloor = $floor;
            $this->loadTables();
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Oops, something went wrong', type: 'error');
            return;
        }
    }

    public function loadTables()
    {
        $this->tables = Meja::where('floor', $this->selectedFloor)->get();
        $this->loadReservedTableIds();
    }

    // Load IDs of tables that have reservations today
    public function loadReservedTableIds()
    {
        $today = Carbon::today();
        $this->reservedTableIds = Reservations::whereDate('reservation_date', $today)
            ->whereNot('status', ['pending', 'canceled'])
            ->pluck('table_id')
            ->toArray();
    }

    #[On('tableStatusUpdated')]
    public function render()
    {
        $this->floor = Meja::select('floor')->distinct()->get();

        return view('livewire.dashboard.tables.index', [
            'tables' => $this->tables,
        ]);
    }

    public function selectTable($id)
    {
        $this->selectedTableId = $id;
        $this->dispatch('open-modal', 'table-detail');
    }
}
