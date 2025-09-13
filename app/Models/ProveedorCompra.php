<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorCompra extends Model
{
    use HasFactory;
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function ProveedorCompraMedidas(){
        return $this->hasMany(ProveedorCompraMedida::class)->with(['SubMedida','MedidaProducto'])->where('estado',1);
    }
    public function ProveedorCategorias(){
        return $this->hasMany(ProveedorCategoria::class)->with(['Categoria','ProveedorCategoriaDetalles'])->where('estado',1);
    }
}
