<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPrecio extends Model
{
    use HasFactory;
    public function ProductoPrecioSucursals()
    {
        return $this->hasMany(ProductoPrecioSucursal::class);
    }
    public function ProductoPrecioLotes()
    {
        return $this->hasMany(ProductoPrecioLote::class)->with('Lote')->where('estado',1);
    }

}
