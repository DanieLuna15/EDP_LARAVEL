<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adeuda extends Model
{
    use HasFactory;
    public function Adeudacuotas(){
        return $this->hasMany(Adeudacuota::class);
    }
}
