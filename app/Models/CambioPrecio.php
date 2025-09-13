<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioPrecio extends Model
{
    use HasFactory;
    public function ItemPrecios()
    {
        return $this->hasMany(ItemPrecio::class)->with('Item')->where('estado',1);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class)->where('estado',1);
    }
}
