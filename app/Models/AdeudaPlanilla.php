<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdeudaPlanilla extends Model
{
    use HasFactory;
    public function Adeuda(){
        return $this->belongsTo(Adeuda::class)->with(['Adeudacuotas']);
    }
}
