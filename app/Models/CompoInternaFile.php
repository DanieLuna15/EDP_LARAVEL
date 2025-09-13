<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoInternaFile extends Model
{
    use HasFactory;
    public function CompoInterna(){
        return $this->belongsTo(CompoInterna::class);
    }
    public function File(){
        return $this->belongsTo(File::class);
    }
}
