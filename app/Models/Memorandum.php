<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    use HasFactory;
    protected $table = "memorandums";
    public function Contrato(){
        return $this->belongsTo(Contrato::class)->with(['Persona']);
    }
    public function Motivomemorandum(){
        return $this->belongsTo(Motivomemorandum::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
