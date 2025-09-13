<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalTiraje extends Model
{
    use HasFactory;
    public function Comprobante(){
        return $this->belongsTo(Comprobante::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
