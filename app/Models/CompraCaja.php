<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCaja extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function CajaProveedor(){
        return $this->belongsTo(CajaProveedor::class);
    }
    public function Almacen(){
        return $this->belongsTo(Almacen::class);
    }
    public function CompraCajaDetalles(){
        return $this->hasMany(CompraCajaDetalle::class)->with(['CajaInventario']);
    }
    public function PagoCompraCajas(){
        return $this->hasMany(PagoCompraCaja::class)->with(['Banco']);
    }
}
