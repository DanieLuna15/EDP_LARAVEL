<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockdotaciondetail extends Model
{
    use HasFactory;
    public function Dotacion(){
        return $this->belongsTo(Dotacion::class);
    }
}
