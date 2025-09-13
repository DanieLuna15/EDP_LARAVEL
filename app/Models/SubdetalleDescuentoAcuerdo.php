<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubdetalleDescuentoAcuerdo extends Model
{
    protected $table = 'subdetalle_descuento_acuerdo';

    protected $fillable = [
        'venta_detalle_pp_id',
        'item_id',
        'item_nombre',
        'acuerdo_id',
        'acuerdo_nombre',
        'peso',
        'cantidad',
        'descuento_valor',
        'total_con_descuento',
        'total_sin_descuento',
    ];

    public function ventaDetallePp()
    {
        return $this->belongsTo(VentaDetallePp::class, 'venta_detalle_pp_id');
    }
    public function pp()
    {
        return $this->belongsTo(Pp::class, 'pp_id');
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
