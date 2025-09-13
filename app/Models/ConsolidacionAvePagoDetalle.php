<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAvePagoDetalle extends Model
{
    use HasFactory;
    protected $table = 'consolidacionave_pago_detalles';
    public function Consolidacion()
    {
        return $this->belongsTo(ConsolidacionAve::class)->with(['Compra']);
    }
}
