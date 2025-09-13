<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaEnvio extends Model
{
    use HasFactory;
    public function Caja(){
        return $this->belongsTo(Caja::class);
    }
    public function AlmacenDestino(){
        return $this->belongsTo(Almacen::class);
    }
    public function AlmacenOrigen(){
        return $this->belongsTo(Almacen::class);
    }
}
