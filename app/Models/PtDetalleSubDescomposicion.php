<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtDetalleSubDescomposicion extends Model
{
    use HasFactory;
    public function CompoExternaDetalle(){
        return $this->belongsTo(CompoExternaDetalle::class);
    }
}
