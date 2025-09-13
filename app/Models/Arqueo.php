<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    use HasFactory;
    public function CajaSucursalUsuario()
    {
        return $this->belongsTo(CajaSucursalUsuario::class)->with(['CajaSucursal']);
    }
    public function ArqueoIngresos()
    {
        return $this->hasMany(ArqueoIngreso::class);
    }
    public function ArqueoVentas(){
        return $this->hasMany(ArqueoVenta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
