<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioGenPpDetalle extends Model
{
    use HasFactory;
    public function EnvioGenPp()
    {
        return $this->belongsTo(EnvioGenPp::class);
    }
    public function DetallePp()
    {
        return $this->belongsTo(DetallePp::class);
    }
}
