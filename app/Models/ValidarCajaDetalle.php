<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidarCajaDetalle extends Model
{
    use HasFactory;
    protected $table = 'validar_caja_detalles';

    public function Origen(){
        return $this->belongsTo(Almacen::class, 'origen_id');
    }
    public function Destino(){
        return $this->belongsTo(Almacen::class, 'destino_id');
    }
    public function validarCaja()
    {
        return $this->belongsTo(ValidarCaja::class, 'validar_caja_id', 'id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }
}
