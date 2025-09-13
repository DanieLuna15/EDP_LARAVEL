<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAve extends Model
{

    use HasFactory;
    protected $table = 'consolidacions_ave';
    protected $casts = [
        'detalle_gastos' => 'array',
    ];
    // public function ConsolidacionPagoDetalle(){
    //     return $this->hasOne(ConsolidacionAvePagoDetalle::class)->where(['estado'=>1]);
    // }
    // public function ConsolidacionPagoDetalle()
    // {
    //     return $this->hasOne(ConsolidacionAvePagoDetalle::class, 'consolidacion_id')->where('estado', 1);
    // }
    public function ConsolidacionPagoDetalle()
    {
        return $this->hasOne(ConsolidacionAvePagoDetalle::class, 'consolidacion_id')->where('estado', 1);
    }
    // public function ConsolidacionDetalles()
    // {
    //     return $this->hasMany(ConsolidacionAveDetalle::class)->with(['Categoria', 'Compra']);
    // }
    public function ConsolidacionDetalles()
    {
        return $this->hasMany(ConsolidacionAveDetalle::class, 'consolidacion_id')->with(['Categoria', 'Compra']);
    }
    // public function Compra()
    // {
    //     return $this->belongsTo(CompraAve::class)->with(['Sucursal']);
    // }
    public function Compra()
    {
        return $this->belongsTo(CompraAve::class, 'compra_ave_id')->with('Sucursal');
    }

    public function CambioPrecioConsolidacions()
    {
        return $this->hasMany(CambioPrecioConsolidacionAve::class, 'consolidacion_id')->with(['User', 'ConsolidacionDetalle']);
    }
}
