<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorCategoriaDetalle extends Model
{
    use HasFactory;
    public function SubMedida(){
        return $this->belongsTo(SubMedida::class);
    }
    public function MedidaProducto(){
        return $this->belongsTo(MedidaProducto::class);
    }
}
