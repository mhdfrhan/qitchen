<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Reservations;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reports extends Component
{
    public $title = 'Weekly Reports';
    public $fromDate;
    public $toDate;
    public $reports = [];

    public function mount()
    {
        // Set tanggal default ke bulan ini
        $this->fromDate = now()->startOfMonth()->toDateString();
        $this->toDate = now()->endOfMonth()->toDateString();
    }

    public function submit()
    {
        $startDate = Carbon::parse($this->fromDate);
        $endDate = Carbon::parse($this->toDate);

        $weeklyReports = [];
        $currentWeekStart = $startDate->copy()->startOfWeek();

        while ($currentWeekStart <= $endDate) {
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek()->min($endDate);

            $weekData = Reservations::select(
                DB::raw('COUNT(*) as total_reservations'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
                ->whereBetween('reservation_date', [$currentWeekStart, $currentWeekEnd])
                ->first();

            if ($weekData->total_reservations > 0) {
                $weeklyReports[] = [
                    'week_start' => $currentWeekStart->toDateString(),
                    'week_end' => $currentWeekEnd->toDateString(),
                    'total_reservations' => $weekData->total_reservations,
                    'total_revenue' => $weekData->total_revenue,
                ];
            }

            $currentWeekStart->addWeek();
        }

        $this->reports = $weeklyReports;
    }

    public function render()
    {
        return view('livewire.dashboard.reports');
    }
}
