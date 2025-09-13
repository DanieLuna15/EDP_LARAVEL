<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioGenPtDetalle extends Model
{
    use HasFactory;
    public function EnvioGenPt()
    {
        return $this->belongsTo(EnvioGenPt::class);
    }
    public function DetallePt()
    {
        return $this->belongsTo(DetallePt::class);
    }
}
