<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItems extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function reservation()
    {
        return $this->belongsTo(Reservations::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
