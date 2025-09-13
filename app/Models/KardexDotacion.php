<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KardexDotacion extends Model
{
    use HasFactory;
    public function Dotacion(){
        return $this->belongsTo(Dotacion::class)->with(['Familia']);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function Familia(){
        return $this->belongsTo(Familia::class);
    }
}
