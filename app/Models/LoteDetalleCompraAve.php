<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteDetalleCompraAve extends Model
{
    use HasFactory;
    protected $table = 'lote_detalle_compras_aves';
    public function LoteDetalle(){
        return $this->belongsTo(LoteAveDetalle::class)->with(['Categoria']);
    }
}
