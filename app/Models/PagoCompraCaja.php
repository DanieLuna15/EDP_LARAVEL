<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCompraCaja extends Model
{
    use HasFactory;
    public function Banco(){
        return $this->belongsTo(Banco::class);
    }
    public function CompraCaja(){
        return $this->belongsTo(CompraCaja::class);
    }
}
