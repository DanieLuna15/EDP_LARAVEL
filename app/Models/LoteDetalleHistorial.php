<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteDetalleHistorial extends Model
{
    use HasFactory;
    public function LoteDetalleSeguimiento()
    {
        return $this->belongsTo(LoteDetalleSeguimiento::class);
    }
    public function LoteDetalleMovimiento()
    {
        return $this->belongsTo(LoteDetalleMovimiento::class);
    }
    public function LoteDetalleCompra()
    {
        return $this->belongsTo(LoteDetalleCompra::class);
    }
    public function LoteDetalleVenta()
    {
        return $this->belongsTo(LoteDetalleVenta::class);
    }
    public function LoteDetalleProducto()
    {
        return $this->belongsTo(LoteDetalleProducto::class);
    }
    public function LoteDetalleCliente()
    {
        return $this->belongsTo(LoteDetalleCliente::class);
    }
}
