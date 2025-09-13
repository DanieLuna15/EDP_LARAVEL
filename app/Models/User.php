<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use Notifiable, HasRoles, HasApiTokens;
    protected $primaryKey = "id";
    protected $fillable   = [
        'nombre', 'apellidos', 'correo', 'usuario', 'estado',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guard_name = 'web';

    public function hasPermission($permission): bool
    {
        foreach ($this->roles as $role) {
            if (in_array($permission, $role->permissions->pluck('name')->toArray())) {
                return true;
            }
        }
        return false;
    }

    public function sellingpointsSucursal()
    {
        return $this->belongsToMany('App\Models\Sucursal', 'usuario_sucursals', 'user_id', 'sucursal_id');
    }
    public function getSellingPointSucursal()
    {

        $selling_point = $this->sellingpointsSucursal;
        return $selling_point;
    }

}
