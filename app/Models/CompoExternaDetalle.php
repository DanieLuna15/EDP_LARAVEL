<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoExternaDetalle extends Model
{
    use HasFactory;
    public function CompoExterna(){
        return $this->belongsTo(CompoExterna::class);
    }
}
