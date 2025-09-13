<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAveNew extends Model
{

    use HasFactory;
    protected $table = 'consolidacions_ave_new';
    protected $casts = [
        'detalle_gastos' => 'array',
    ];
    public function ConsolidacionPagoDetalle()
    {
        return $this->hasOne(ConsolidacionAveNewPagoDetalle::class, 'consolidacion_id')->where('estado', 1);
    }
    public function ConsolidacionDetalles()
    {
        return $this->hasMany(ConsolidacionAveNewDetalle::class, 'consolidacion_id')->with(['Categoria', 'Compra']);
    }
    public function Compra()
    {
        return $this->belongsTo(CompraAve::class, 'compra_ave_id')->with('Sucursal');
    }

    public function CambioPrecioConsolidacions()
    {
        return $this->hasMany(CambioPrecioConsolidacionAveNew::class, 'consolidacion_id')->with(['User', 'ConsolidacionDetalle']);
    }
    public function Sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
