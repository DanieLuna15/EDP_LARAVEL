<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtSobraPp extends Model
{
    use HasFactory;
    public function SobraPp()
    {
        return $this->belongsTo(SobraPp::class)->with(['Pp','SobraDetallePps']);
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }
}
