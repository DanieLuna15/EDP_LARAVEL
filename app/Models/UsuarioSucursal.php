<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioSucursal extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $table      = "usuario_sucursals";
    protected $primaryKey = 'id';

    public function sucursal()
    {
        return $this->hasOne('App\Models\Sucursal', 'id', 'sucursal_id')->select('id', 'nombre', 'documento_id', 'doc', 'telefono', 'email', 'responsable', 'encargado', 'medidor', 'direccion');
    }
    public function usuarios()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->select('id', 'usr_usuario', 'name');
    }
}
