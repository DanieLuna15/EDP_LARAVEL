<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillacosto extends Model
{
    use HasFactory;
    public function Costovariable()
    {
        return $this->belongsTo(Costovariable::class);
    }
    public function costofijo()
    {
        return $this->belongsTo(Costofijo::class, 'costofijo_id');
    }
}
