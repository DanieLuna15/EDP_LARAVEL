<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Filesucursals(){
        return $this->hasMany(Filesucursal::class)->with(['Tipoarchivo','File'])->where('estado',1);
    }
}
