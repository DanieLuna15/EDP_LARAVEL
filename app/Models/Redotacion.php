<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redotacion extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Contrato(){
        return $this->belongsTo(Contrato::class)->with(['Persona']);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class)->with(['Documento']);
    }
    public function Redotaciondetalles(){
        return $this->hasMany(Redotaciondetalle::class)->with(['Stockdotaciondetail']);
    }
}
