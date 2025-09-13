<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioPrecioConsolidacion extends Model
{
    use HasFactory;
    public function ConsolidacionDetalle(){
        return $this->belongsTo(ConsolidacionDetalle::class)->with(['Categoria','Compra']);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
