<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionDetalle extends Model
{
    use HasFactory;
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class)->with(['ProveedorCompra']);
    }
    public function CambioPrecioConsolidacions(){
        return $this->hasMany(CambioPrecioConsolidacion::class);
    }
}
