<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SobraPp extends Model
{
    use HasFactory;
    public function Pp()
    {
        return $this->belongsTo(Pp::class)->with(['Sucursal','DetallePps']);
    }
    public function SobraDetallePps()
    {
        return $this->hasMany(SobraDetallePp::class)->with(['Item']);
    }
    public function PtSobraPp()
    {
        return $this->hasOne(PtSobraPp::class)->with('Pt');
    }
}
