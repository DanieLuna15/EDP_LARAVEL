<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpDetalleDescomposicion extends Model
{
    use HasFactory;
    public function CompoInterna(){
        return $this->belongsTo(CompoInterna::class);
    }
    public function PpDetalle(){
        return $this->belongsTo(PpDetalle::class)->with(['LoteDetalle']);
    }
}
