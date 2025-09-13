<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finiaguinaldodetalle extends Model
{
    use HasFactory;
    public function Planilla(){
        return $this->belongsTo(Planilla::class);
    }
}
