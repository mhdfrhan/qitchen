<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'tables';
    protected $guarded = ['id'];

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
