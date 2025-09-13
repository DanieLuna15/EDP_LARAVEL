<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoDotacion extends Model
{
    use HasFactory;
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function SucursalDestino(){
        return $this->belongsTo(Sucursal::class,'sucursal_destino_id');
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function TraspasoDotacionDetalles(){
        return $this->hasMany(TraspasoDotacionDetalle::class)->with(['Stockdotaciondetail']);
    }
}
