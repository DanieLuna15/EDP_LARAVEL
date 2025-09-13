<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetallePp extends Model
{
    use HasFactory;
    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
    public function Pp()
    {
        return $this->belongsTo(Pp::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class)->with(['User']);
    }
    public function CintaCliente(){
        return $this->belongsTo(CintaCliente::class);
    }
    public function subdetalleDescuentoAcuerdo()
    {
        return $this->hasOne(SubdetalleDescuentoAcuerdo::class, 'venta_detalle_pp_id');
    }
}
