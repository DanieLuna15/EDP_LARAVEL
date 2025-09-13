<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAveNewPagoDetalle extends Model
{
    use HasFactory;
    protected $table = 'consolidacionavenew_pago_detalles';
    public function Consolidacion()
    {
        return $this->belongsTo(ConsolidacionAveNew::class)->with(['Compra']);
    }
}
