<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioGenPp extends Model
{
    use HasFactory;
    public function EnvioGenPpDetalles()
    {
        return $this->hasMany(EnvioGenPpDetalle::class);
    }
    public function Pp()
    {
        return $this->belongsTo(Pp::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
