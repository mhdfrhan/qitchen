<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return view('dashboard.reservations.index',[
            'title' => 'Reservations',
        ]);
    }

    // koki detail reservation
    public function detail($code)
    {
        $reservation = Reservations::where('reservation_code', $code)->first();
        return view('dashboard.kitchen.detail-reservation',[
            'title' => 'Reservation Table ' . $reservation->table->table_number,
            'reservation' => $reservation
        ]);
    }
}
