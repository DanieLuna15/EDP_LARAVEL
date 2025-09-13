<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteDetalle extends Model
{
    use HasFactory;
    public function PpDetalles(){
        return $this->hasMany(PpDetalle::class)->with(['LoteDetalle'])->where('estado',1);
    }
    public function LoteDetalleMovimientos(){
        return $this->hasMany(LoteDetalleMovimiento::class)->where('estado',1);
    }
    public function LoteDetalleProductos(){
        return $this->hasMany(LoteDetalleProducto::class)->where('estado',1);
    }
    public function LoteDetalleSeguimientos(){
        return $this->hasMany(LoteDetalleSeguimiento::class)->where('estado',1);
    }
    public function LoteDetalleCompras(){
        return $this->hasMany(LoteDetalleCompra::class)->where('estado',1);
    }
    public function Lote(){
        return $this->belongsTo(Lote::class)->with(['Compra','User'])->where('estado',1);
    }
    public function CompraInventario(){
        return $this->belongsTo(CompraInventario::class)->where('estado',1);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class)->with(['ProveedorCompra']);
    }
}
