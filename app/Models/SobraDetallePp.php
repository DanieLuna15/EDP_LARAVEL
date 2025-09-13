<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SobraDetallePp extends Model
{
    use HasFactory;
    public function SobraPp()
    {
        return $this->belongsTo(SobraPp::class)->with(['Pp']);
    }
    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
