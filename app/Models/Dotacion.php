<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotacion extends Model
{
    use HasFactory;
    public function Familia(){
        return $this->belongsTo(Familia::class);
    }
}
