<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpEnvioTransformacionDetalle extends Model
{
    use HasFactory;

    public function Pp(){
        return $this->belongsTo(Pp::class,'pp_id');
    }
}
