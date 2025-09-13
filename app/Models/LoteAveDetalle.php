<?php

namespace App\Models;

use App\Models\LoteDetalleCompraAve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoteAveDetalle extends Model
{
    use HasFactory;
    protected $table = 'lote_aves_detalles';
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
    public function LoteDetalleCompraAves(){
        return $this->hasMany(LoteDetalleCompraAve::class)->where('estado',1);
    }
    public function Lote(){
        return $this->belongsTo(LoteAve::class)->with(['Compra','User'])->where('estado',1);
    }
    public function CompraInventario(){
        return $this->belongsTo(CompraAveInventario::class)->where('estado',1);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function Compra(){
        return $this->belongsTo(CompraAve::class)->with(['ProveedorCompra']);
    }
}
