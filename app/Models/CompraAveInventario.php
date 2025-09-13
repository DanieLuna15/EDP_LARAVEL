<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraAveInventario extends Model
{
    use HasFactory;
    protected $table = 'compra_ave_inventarios';

    public function Inventario(){
        return $this->belongsTo(AveInventario::class)->with(['Producto']);
    }
    public function MedidaProducto(){
        return $this->belongsTo(MedidaProducto::class)->with(['SubMedidas']);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function SubMedida(){
        return $this->belongsTo(SubMedida::class)->with(['MedidaProducto']);
    }
    public function SubOriginal(){
        return $this->belongsTo(SubMedida::class)->with(['MedidaProducto']);
    }
    public function SubMedidaSimple(){
        return $this->belongsTo(SubMedida::class);
    }
}
