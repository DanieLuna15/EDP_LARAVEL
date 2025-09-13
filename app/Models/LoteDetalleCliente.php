<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteDetalleCliente extends Model
{
    use HasFactory;
    public function LoteDetalle(){
        return $this->belongsTo(LoteDetalle::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
