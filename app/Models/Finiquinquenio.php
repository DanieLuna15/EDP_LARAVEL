<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finiquinquenio extends Model
{
    use HasFactory;
    public function Contrato(){
        return $this->belongsTo(Contrato::class)->with(['Persona']);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Finiquinqueniodetalles(){
        return $this->hasMany(Finiquinqueniodetalle::class)->with(['Planilla']);
    }
}
