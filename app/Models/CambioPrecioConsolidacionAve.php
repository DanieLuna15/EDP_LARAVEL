<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioPrecioConsolidacionAve extends Model
{
    use HasFactory;
    protected $table = 'cambio_precio_consolidacion_aves';
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function consolidacionDetalle()
    {
        return $this->belongsTo(ConsolidacionAveDetalle::class, 'consolidacion_detalle_id');
    }

    public function consolidacion()
    {
        return $this->belongsTo(ConsolidacionAve::class, 'consolidacion_id');
    }
}
