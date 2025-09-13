<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDesPtDetalleDesco extends Model
{
    use HasFactory;
    public function CompoExternaDetalle(){
        return $this->belongsTo(CompoExternaDetalle::class)->with(['CompoExterna']);
    }
    public function PtDetalleDescomposicion(){
        return $this->belongsTo(PtDetalleDescomposicion::class)->with(['CompoExterna']);
    }
    public function PtDetalle(){
        return $this->belongsTo(PtDetalle::class)->with(['LoteDetalle','Lote']);
    }
}
