<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratocosto extends Model
{
    use HasFactory;
    public function Costofijo(){
        return $this->belongsTo(Costofijo::class);
    }
}
