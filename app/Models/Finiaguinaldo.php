<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finiaguinaldo extends Model
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
    public function Finiaguinaldodetalles(){
        return $this->hasMany(Finiaguinaldodetalle::class)->with(['Planilla']);
    }
}
