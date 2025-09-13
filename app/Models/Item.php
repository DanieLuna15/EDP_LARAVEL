<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function ItemFiles()
    {
        return $this->hasMany(ItemFile::class)->with('File')->where('estado',1);
    }
    public function ItemPrecios()
    {
        return $this->hasMany(ItemPrecio::class)->where('estado',1);
    }
    public function ItemPollos()
    {
        return $this->hasMany(ItemPollo::class)->where('estado',1);
    }
    public function SubItems()
    {
        return $this->hasMany(SubItem::class)->with('SubItem')->where('estado',1);
    }
}
