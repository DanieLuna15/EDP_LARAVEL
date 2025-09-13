<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollolimpioSucursal extends Model
{
    use HasFactory;
    public function PollolimpioCambio()
    {
        return $this->belongsTo(PollolimpioCambio::class);
    }
    public function Pollolimpio()
    {
        return $this->belongsTo(Pollolimpio::class);
    }
}
