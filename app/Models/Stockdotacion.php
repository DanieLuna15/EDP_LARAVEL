<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockdotacion extends Model
{
    use HasFactory;
    public function Proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
    public function Formapago(){
        return $this->belongsTo(Formapago::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Stockdotaciondetails(){
        return $this->hasMany(Stockdotaciondetail::class)->with(['Dotacion']);
    }
}
