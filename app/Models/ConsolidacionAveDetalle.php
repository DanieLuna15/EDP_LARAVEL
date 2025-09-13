<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidacionAveDetalle extends Model
{
    use HasFactory;
    protected $table = 'consolidacion_ave_detalles';
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function Compra()
    {
        return $this->belongsTo(CompraAve::class, 'compra_ave_id')->with('ProveedorCompra');
    }

    public function CambioPrecioConsolidacions()
    {
        return $this->hasMany(CambioPrecioConsolidacionAve::class, 'consolidacion_detalle_id');
    }
}
