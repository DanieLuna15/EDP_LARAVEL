<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public function MedidaProductos(){
        return $this->hasMany(MedidaProducto::class)->with(['Medida','SubMedidas'])->where('estado',1);
    }
    public function MedidaProducto(){
        return $this->hasOne(MedidaProducto::class)->with(['Medida']);
    }
}
