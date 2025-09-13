<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtTraspasoPp extends Model
{
    use HasFactory;
    public function TraspasoPp()
    {
        return $this->belongsTo(TraspasoPp::class)->with(['Pp', 'Detalles'])->where('estado',1);
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
