<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioGenPt extends Model
{
    use HasFactory;
    public function EnvioGenPtDetalles()
    {
        return $this->hasMany(EnvioGenPtDetalle::class);
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
