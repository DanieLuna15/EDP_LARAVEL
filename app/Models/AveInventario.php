<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AveInventario extends Model
{
    protected $table = 'ave_inventarios';
    use HasFactory;
    public function Producto(){
        return $this->belongsTo(Producto::class)->with(['MedidaProducto']);
    }
    public function MedidaProducto(){
        return $this->belongsTo(MedidaProducto::class)->with(['Medida']);
    }
}
