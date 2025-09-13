<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoInterna extends Model
{
    use HasFactory;
    public function CompoInternaFiles(){
        return $this->hasMany(CompoInternaFile::class)->with(['File'])->where('estado',1);
    }
}
