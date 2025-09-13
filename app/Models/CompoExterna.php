<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoExterna extends Model
{
    use HasFactory;
    public function CompoExternaDetalles(){
        return $this->hasMany(CompoExternaDetalle::class)->where('estado',1);
    }
    public function CompoExternaFiles(){
        return $this->hasMany(CompoExternaFile::class)->with(['File'])->where('estado',1);
    }
}
