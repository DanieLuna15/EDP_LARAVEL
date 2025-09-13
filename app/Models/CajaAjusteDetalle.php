<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaAjusteDetalle extends Model
{
    use HasFactory;
    
    public function CajaInventario(){
        return $this->belongsTo(CajaInventario::class)->with(['Caja','Almacen']);
    }
}
