<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidarCaja extends Model
{
    use HasFactory;
    public function Compra(){
        return $this->belongsTo(Compra::class);
    }
    public function CajaCompra(){
        return $this->belongsTo(CajaCompra::class);
    }
    public function Origen(){
        return $this->belongsTo(Almacen::class);
    }
    public function Destino(){
        return $this->belongsTo(Almacen::class);
    }
    public function ValidarCajaDetalles(){
        return $this->hasMany(ValidarCajaDetalle::class)->with(['Origen','Destino']);
    }
}
