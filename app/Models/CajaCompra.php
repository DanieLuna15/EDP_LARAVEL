<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCompra extends Model
{
    use HasFactory;
    public function Caja(){
        return $this->belongsTo(Caja::class);
    }
    public function CajaInventario(){
        return $this->belongsTo(CajaInventario::class)->with(['Almacen','Caja']);
    }
    public function Compra(){
        return $this->belongsTo(Compra::class)->with(['Consolidacion','ProveedorCompra','User']);
    }
    public function validarCaja()
    {
        return $this->hasOne(ValidarCaja::class, 'compra_id', 'compra_id');
    }

}
