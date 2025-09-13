<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidadotacliente extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class)->with(['Documento']);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class)->with(['Documento']);
    }
   
    
    public function Salidadotaclidetalles(){
        return $this->hasMany(Salidadotaclidetalle::class)->with(['Stockdotaciondetail']);
    }
}
