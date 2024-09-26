<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function table()
    {
        return $this->belongsTo(Meja::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(ReservationItems::class, 'reservation_id');
    }

    public function discounts()
    {
        return $this->belongsTo(Discounts::class, 'discount_id');
    }
}
