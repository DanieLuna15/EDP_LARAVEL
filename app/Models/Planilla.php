<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;
    public function Contrato(){
        return $this->belongsTo(Contrato::class)->with(['Persona','Adeudas','Area']);
    }
    public function Adeudas(){
        return $this->hasMany(Adeuda::class)->with(['Adeudacuotas'])->where('estado',1);
    }
    public function AdeudaPlanillas(){
        return $this->hasMany(AdeudaPlanilla::class)->with(['Adeuda'])->where('estado',1);
    }
    public function Planillacostos(){
        return $this->hasMany(Planillacosto::class)->with(['Costovariable']);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
