<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDesDetallePt extends Model
{
    use HasFactory;
    public function DetallePt()
    {
        return $this->belongsTo(DetallePt::class)->with(['LoteDetalle','Pt']);
    }
    public function CompoExternaDetalle()
    {
        return $this->belongsTo(CompoExternaDetalle::class)->with(['CompoExterna']);
    }
}
