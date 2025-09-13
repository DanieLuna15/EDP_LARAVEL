<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionPagoDetalle extends Model
{
    use HasFactory;
    public function Consolidacion(){
        return $this->belongsTo(Consolidacion::class)->with(['Compra']);
    }
}
