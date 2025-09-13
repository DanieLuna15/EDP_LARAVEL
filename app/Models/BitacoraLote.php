<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraLote extends Model
{
    use HasFactory;
    public function Lote(){
        return $this->belongsTo(Lote::class)->with(['Compra','User']);
    }
}
