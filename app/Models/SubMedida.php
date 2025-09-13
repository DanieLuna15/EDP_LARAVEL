<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMedida extends Model
{
    use HasFactory;
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function MedidaProducto(){
        return $this->belongsTo(MedidaProducto::class)->with(['Medida']);
    }
}
