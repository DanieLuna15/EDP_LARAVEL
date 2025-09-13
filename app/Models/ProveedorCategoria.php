<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorCategoria extends Model
{
    use HasFactory;
    public function ProveedorCompra()
    {
        return $this->belongsTo(ProveedorCompra::class);
    }
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function ProveedorCategoriaDetalles()
    {
        return $this->hasMany(ProveedorCategoriaDetalle::class)->with(['SubMedida','MedidaProducto'])->where('estado', 1);
    }
}
