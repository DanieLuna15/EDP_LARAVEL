<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioPrecioConsolidacionAveNew extends Model
{
    use HasFactory;
    protected $table = 'cambio_precio_consolidacion_aves_new';
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function consolidacionDetalle()
    {
        return $this->belongsTo(ConsolidacionAveNewDetalle::class, 'consolidacion_detalle_id');
    }

    public function consolidacion()
    {
        return $this->belongsTo(ConsolidacionAveNew::class, 'consolidacion_id');
    }
}
