<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoCaja extends Model
{
    use HasFactory;
    public function Caja(){
        return $this->belongsTo(Caja::class);
    }
    public function AlmacenDestino(){
        return $this->belongsTo(Almacen::class)->with(["Sucursal"]);
    }
    public function AlmacenOrigen(){
        return $this->belongsTo(Almacen::class)->with(["Sucursal"]);
    }
}
