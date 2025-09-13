<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRol extends Model
{
    use HasFactory;
    protected $table      = 'menu_roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'menu_id',
        'rol_id',
        'check',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class, 'id');
    }
}
