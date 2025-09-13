<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoPp extends Model
{
    use HasFactory;
    public function Pp(){
        return $this->belongsTo(Pp::class);
    }
    public function TraspasoPpDetalles(){
        return $this->hasMany(TraspasoPpDetalle::class);
    }
    public function TraspasoPpEnvios(){
        return $this->hasMany(TraspasoPpEnvio::class);
    }
    public function CintaCliente(){
        return $this->belongsTo(CintaCliente::class);
    }
    public function Detalles(){
        return $this->TraspasoPpDetalles();
    }
}
