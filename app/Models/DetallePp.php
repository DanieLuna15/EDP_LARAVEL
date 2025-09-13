<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePp extends Model
{
    use HasFactory;
    public function Pp(){
        return $this->belongsTo(Pp::class);
    }
    public function LoteDetalle()
    {
        return $this->belongsTo(LoteDetalle::class)->with(['Lote']);
    }
    public function DetallePpDescomposicions()
    {
        return $this->hasMany(DetallePpDescomposicion::class)->with(['CompoInterna',]);
    }
    public function LoteDetalleMovimiento()
    {
        return $this->belongsTo(LoteDetalleMovimiento::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
