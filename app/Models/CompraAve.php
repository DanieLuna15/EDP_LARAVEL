<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraAve extends Model
{
    use HasFactory;
    protected $table = 'compras_aves';
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function ProveedorCompra()
    {
        return $this->belongsTo(ProveedorCompra::class)->with(['ProveedorCategorias']);
    }
    public function CajaCompras()
    {
        return $this->hasMany(CajaCompraAve::class)->with(['CajaInventario']);
    }
    public function CompraInventarios()
    {
        return $this->hasMany(CompraAveInventario::class)->with(['Inventario', 'SubMedida', 'Categoria', 'MedidaProducto', 'SubOriginal'])->where('estado', 1);
    }
    public function ConsolidacionDetalles()
    {
        return $this->hasMany(ConsolidacionAveDetalle::class)->where('estado', 1);
    }
    public function Consolidacion()
    {
        return $this->hasOne(ConsolidacionAve::class)->where('estado', 1);
    }

    // public function ConsolidacionDetalles()
    // {
    //     return $this->hasMany(ConsolidacionAveNewDetalle::class)->where('estado', 1);
    // }
    // public function Consolidacion()
    // {
    //     return $this->hasOne(ConsolidacionAveNew::class)->where('estado', 1);
    // }
    
    public function CompraInventariosWithout()
    {
        return $this->hasMany(CompraAveInventario::class)->with(['Inventario', 'SubMedida', 'Categoria', 'MedidaProducto', 'SubOriginal'])->where('estado', 1);
    }
    public function Lote()
    {
        return $this->hasOne(LoteAve::class)->where('estado', 1);
    }
    public function LoteDetalleCompras()
    {
        return $this->hasMany(LoteDetalleCompraAve::class)->with(['LoteDetalle'])->where('estado', 1);
    }
}
