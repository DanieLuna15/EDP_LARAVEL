<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidotacontradeta extends Model
{
    use HasFactory;
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class)->with(['Documento']);
    }
    public function Stockdotaciondetail(){
        return $this->belongsTo(Stockdotaciondetail::class)->with(['Dotacion']);
    }
}
