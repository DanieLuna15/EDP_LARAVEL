<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function ProveedorCompra(){
        return $this->belongsTo(ProveedorCompra::class)->with(['ProveedorCategorias']);
    }
    public function CajaCompras(){
        return $this->hasMany(CajaCompra::class)->with(['CajaInventario']);
    }
    public function CompraInventarios(){
        return $this->hasMany(CompraInventario::class)->with(['Inventario','SubMedida','Categoria','MedidaProducto','SubOriginal'])->where('estado',1);
    }
    public function ConsolidacionDetalles(){
        return $this->hasMany(ConsolidacionDetalle::class)->where('estado',1);
    }
    public function CompraInventariosWithout(){
        return $this->hasMany(CompraInventario::class)->with(['Inventario','SubMedida','Categoria','MedidaProducto','SubOriginal'])->where('estado',1);
    }
    public function Consolidacion(){
        return $this->hasOne(Consolidacion::class)->where('estado',1);
    }
    public function Lote(){
        return $this->hasOne(Lote::class)->where('estado',1);
    }
    public function LoteDetalleCompras(){
        return $this->hasMany(LoteDetalleCompra::class)->with(['LoteDetalle'])->where('estado',1);
    }
}
