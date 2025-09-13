<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollolimpio extends Model
{
    use HasFactory;
    public function PollolimpioSucursals()
    {
        return $this->hasMany(PollolimpioSucursal::class);
    }
}
