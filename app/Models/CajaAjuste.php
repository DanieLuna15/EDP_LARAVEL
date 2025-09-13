<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaAjuste extends Model
{
    use HasFactory;
    public function CajaAjusteDetalles(){
        return $this->hasMany(CajaAjusteDetalle::class)->with(['CajaInventario']);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
