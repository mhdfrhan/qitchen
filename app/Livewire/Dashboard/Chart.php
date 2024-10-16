<?php

namespace App\Livewire\Dashboard;

use App\Models\Reservations;
use App\Models\Menu;
use App\Models\User;
use App\Models\ReservationItems;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $totalReservationsByMonth = [];
    public $totalRevenueByMonth = [];
    public $favoriteMenus = [];
    public $favoriteMenuLabels = [];
    public $favoriteMenuData = [];
    public $totalFavoriteMenus = 0;
    public $totalRevenue = 0;
    public $totalReservations = 0;
    public $totalCustomers = 0;
    public $totalMenus = 0;
    public $revenueChangePercentage, $reservationChangePercentage, $customerChangePercentage;

    public $colors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)', 
        'rgba(255, 206, 86, 1)', 
        'rgba(75, 192, 192, 1)', 
        'rgba(153, 102, 255, 1)', 
    ];

    public function mount()
    {
        $this->totalReservationsByMonth = Reservations::query()
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($reservation) {
                return Carbon::parse($reservation->created_at)->format('F');
            })
            ->map(function ($reservations) {
                return $reservations->count();
            })
            ->toArray();

        $this->totalRevenueByMonth = Reservations::query()
            ->whereNotIn('status', ['pending', 'canceled'])
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($reservation) {
                return Carbon::parse($reservation->created_at)->format('F');
            })
            ->map(function ($reservations) {
                return $reservations->sum('total_amount');
            })
            ->toArray();

        $currentMonth = date('F');
        $previousMonth = date('F', strtotime('-1 month'));

        $currentRevenue = $this->totalRevenueByMonth[$currentMonth] ?? 0;
        $previousRevenue = $this->totalRevenueByMonth[$previousMonth] ?? 0;

        if ($previousRevenue > 0) {
            $this->revenueChangePercentage = (($currentRevenue - $previousRevenue) / $previousRevenue) * 100;
        } else {
            $this->revenueChangePercentage = $currentRevenue > 0 ? 100 : 0;
        }
        

        $currentMonthReservations = Reservations::query()
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        $previousMonthReservations = Reservations::query()
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m', strtotime('-1 month')))
            ->count();

        if ($previousMonthReservations > 0) {
            $this->reservationChangePercentage = (($currentMonthReservations - $previousMonthReservations) / $previousMonthReservations) * 100;
        } else {
            $this->reservationChangePercentage = $currentMonthReservations > 0 ? 100 : 0;
        }

        $this->totalReservations = $currentMonthReservations;

        $this->totalCustomers = User::query()
            ->whereNot('role', 'admin')
            ->count();

        $currentMonthCustomers = User::query()
            ->whereNot('role', 'admin')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        $previousMonthCustomers = User::query()
            ->whereNot('role', 'admin')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m', strtotime('-1 month')))
            ->count();

        if ($previousMonthCustomers > 0) {
            $this->customerChangePercentage = (($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100;
        } else {
            $this->customerChangePercentage = $currentMonthCustomers > 0 ? 100 : 0;
        }

        $this->totalMenus = Menu::query()->count();

        $this->favoriteMenus = ReservationItems::query()
            ->select('menu_id', DB::raw('COUNT(*) as count'))
            ->whereHas('reservation', function ($query) {
                $query->whereNotIn('status', ['pending', 'canceled']);
            })
            ->groupBy('menu_id')
            ->orderBy('count', 'desc')
            ->take(5)
            ->with('menu')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->menu->name,
                    'count' => $item->count,
                ];
            })
            ->toArray();

        $this->favoriteMenuLabels = array_column($this->favoriteMenus, 'name');
        $this->favoriteMenuData = array_column($this->favoriteMenus, 'count');
        $this->totalFavoriteMenus = array_sum($this->favoriteMenuData);
    }

    public function render()
    {
        return view('livewire.dashboard.chart', [
            'totalReservationsByMonth' => $this->totalReservationsByMonth,
            'totalRevenueByMonth' => $this->totalRevenueByMonth,
            'favoriteMenus' => $this->favoriteMenus,
        ]);
    }
}
