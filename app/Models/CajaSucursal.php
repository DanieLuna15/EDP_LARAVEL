<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaSucursal extends Model
{
    use HasFactory;
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function CajaSucursalUsuarios(){
        return $this->hasMany(CajaSucursalUsuario::class)->with(['User'])->where('estado',1);
    }
}
