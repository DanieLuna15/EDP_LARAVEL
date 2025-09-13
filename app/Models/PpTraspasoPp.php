<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpTraspasoPp extends Model
{
    use HasFactory;
    public function TraspasoPp()
    {
        return $this->belongsTo(TraspasoPp::class)->with(['Pp'])->where('estado',1);
    }
    public function CintaCliente()
    {
        return $this->belongsTo(CintaCliente::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Pp()
    {
        return $this->belongsTo(Pp::class);
    }
}
