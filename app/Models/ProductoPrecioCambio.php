<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPrecioCambio extends Model
{
    use HasFactory;
    public function ProductoPrecioSucursals()
    {
        return $this->hasMany(ProductoPrecioSucursal::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
