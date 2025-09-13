<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaTurnoChofer extends Model
{
    use HasFactory;
    public function TurnoChofer()
    {
        return $this->belongsTo(TurnoChofer::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class)->with(['Cliente']);
    }
}
