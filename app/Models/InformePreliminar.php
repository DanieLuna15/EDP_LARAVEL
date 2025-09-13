<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformePreliminar extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class)->with(['Documento']);
    }
    public function InformeDetalles(){
        return $this->hasMany(InformeDetalle::class)->with(['CompoExterna']);
    }
}
