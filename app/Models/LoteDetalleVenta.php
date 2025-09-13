<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteDetalleVenta extends Model
{
    use HasFactory;
    public function LoteDetalle()
    {
        return $this->belongsTo(LoteDetalle::class);
    }
    public function LoteDetalleHistorial(){
        return $this->hasOne(LoteDetalleHistorial::class);
    }

}
