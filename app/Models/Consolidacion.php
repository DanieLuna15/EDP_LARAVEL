<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consolidacion extends Model
{
    use HasFactory;
    protected $casts = [
        'detalle_gastos' => 'array',
    ];
    public function ConsolidacionPagoDetalle()
    {
        return $this->hasOne(ConsolidacionPagoDetalle::class)->where(['estado' => 1]);
    }
    public function ConsolidacionDetalles()
    {
        return $this->hasMany(ConsolidacionDetalle::class)->with(['Categoria', 'Compra']);
    }
    public function Compra()
    {
        return $this->belongsTo(Compra::class)->with(['Sucursal']);
    }
    public function CambioPrecioConsolidacions()
    {
        return $this->hasMany(CambioPrecioConsolidacion::class)->with(['User', 'ConsolidacionDetalle']);
    }
}
