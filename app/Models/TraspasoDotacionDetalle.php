<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraspasoDotacionDetalle extends Model
{
    use HasFactory;

    public function Stockdotaciondetail(){
        return $this->belongsTo(Stockdotaciondetail::class)->with(['Dotacion']);
    }
}
