<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaSucursalUsuario extends Model
{
    use HasFactory;
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function CajaSucursal()
    {
        return $this->belongsTo(CajaSucursal::class);
    }
    public function arqueos()
    {
        return $this->hasMany(Arqueo::class, 'caja_sucursal_usuario_id');
    }
}
