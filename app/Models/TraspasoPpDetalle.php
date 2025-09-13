<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoPpDetalle extends Model
{
    use HasFactory;
    public function TraspasoPp(){
        return $this->belongsTo(TraspasoPp::class);
    }
    public function LoteDetalle(){
        return $this->belongsTo(LoteDetalle::class);
    }
}
