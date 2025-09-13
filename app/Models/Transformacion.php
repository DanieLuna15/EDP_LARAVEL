<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transformacion extends Model
{
    use HasFactory;
    public function TransformacionItem()
    {
        return $this->hasOne(TransformacionItem::class)->with(['Item'])->orderBy('id','desc');
    }
    public function TransformacionSucursal()
    {
        return $this->hasOne(TransformacionSucursal::class)->orderBy('id','desc');
    }
    public function TransformacionDetalles()
    {
        return $this->hasMany(TransformacionDetalle::class);
    }
}
