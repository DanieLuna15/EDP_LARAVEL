<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajustedotacion extends Model
{
    use HasFactory;
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class)->with(['Documento']);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Ajustedotaciondetalles(){
        return $this->hasMany(Ajustedotaciondetalle::class)->with(['Stockdotaciondetail']);
    }
}
