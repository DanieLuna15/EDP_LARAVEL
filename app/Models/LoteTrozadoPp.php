<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteTrozadoPp extends Model
{
    use HasFactory;
    public function Lote()
    {
        return $this->belongsTo(Lote::class)->with(['LoteDetalles','Compra','User']);
    }
    public function PpDetalle()
    {
        return $this->belongsTo(PpDetalle::class)->with(['LoteDetalle']);
    }
}
