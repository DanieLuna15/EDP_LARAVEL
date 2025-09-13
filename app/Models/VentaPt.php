<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaPt extends Model
{
    use HasFactory;
    public function Venta()
    {
        return $this->belongsTo(Venta::class)->with('Cliente');
    }
    public function Pt()
    {
        return $this->belongsTo(Pt::class);
    }
}
