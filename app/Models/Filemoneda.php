<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filemoneda extends Model
{
    use HasFactory;

    public function File()
    {
        return $this->belongsTo(File::class);
    }

    public function Tipoarchivo()
    {
        return $this->belongsTo(Tipoarchivo::class);
    }
}
