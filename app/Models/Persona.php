<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Filepersonas(){
        return $this->hasMany(Filepersona::class)->with(['Tipoarchivo','File'])->where('estado',1);
    }
}
