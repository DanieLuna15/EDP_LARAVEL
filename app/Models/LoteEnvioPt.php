<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteEnvioPt extends Model
{
    use HasFactory;
    public function Lote()
    {
        return $this->belongsTo(Lote::class)->with(['LoteDetalles','Compra','User']);
    }
    public function PtDetalle()
    {
        return $this->belongsTo(PtDetalle::class);
    }
    public function LoteDetalle()
    {
        return $this->belongsTo(LoteDetalle::class);
    }
    public function LoteDetalleMovimiento()
    {
        return $this->belongsTo(LoteDetalleMovimiento::class);
    }
}
