<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnoChofer extends Model
{
    use HasFactory;
    public function Chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
    public function VentaTurnoChofers()
    {
        return $this->hasMany(VentaTurnoChofer::class)->with(['Venta'])->where([['estado',1],['entregado',1]]);
    }
}
