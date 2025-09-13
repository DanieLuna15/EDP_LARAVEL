<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePtDescomposicion extends Model
{
    use HasFactory;
    public function DetallePt()
    {
        return $this->belongsTo(DetallePt::class)->with(['LoteDetalle','Pt']);
    }
    public function CompoExterna()
    {
        return $this->belongsTo(CompoExterna::class)->with(['CompoExternaDetalles']);
    }
    public function SubDesDetallePts()
    {
        return $this->hasMany(SubDesDetallePt::class)->with(['CompoExternaDetalle'])->where('estado',1);
    }
}
