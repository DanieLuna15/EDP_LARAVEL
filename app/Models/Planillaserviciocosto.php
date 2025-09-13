<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillaserviciocosto extends Model
{
    use HasFactory;
    public function costovariable()
    {
        return $this->belongsTo(Costovariable::class, 'costovariable_id');  
    }
}
