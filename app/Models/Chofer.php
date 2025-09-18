<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Documento()
    {
        return $this->belongsTo(Documento::class);
    }
    public function EstadoCompraChofer()
    {
        return $this->belongsTo(EstadoCompraChofer::class);
    }
    public function TurnoChofer()
    {
        return $this->hasOne(TurnoChofer::class)->with(['VentaTurnoChofers'])->where([['estado',1],['apertura',1]])->orderBy('id','desc');
    }
}
