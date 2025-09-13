<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollolimpioCambio extends Model
{
    use HasFactory;
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function PollolimpioSucursals()
    {
        return $this->hasMany(PollolimpioSucursal::class)->with('Pollolimpio');
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
