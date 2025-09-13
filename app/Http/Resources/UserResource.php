<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->usr_foto) {
            $foto = '/avatar/' . $this->usr_foto;
        } else {
            $foto = 'https://thumbs.dreamstime.com/b/faceless-businessman-avatar-man-suit-blue-tie-human-profile-userpic-face-features-web-picture-gentlemen-85824471.jpg';
        }
        return [
            'id'          => $this->id,
            'nombre'      => $this->nombre,
            'apellidos'   => $this->apellidos,
            'correo'      => $this->correo,
            'usuario'     => $this->usuario,
            'estado'      => $this->estado,
            'roles'       => array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            ),
            'permissions' => array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            ),
            'avatar'      => $foto,
        ];
    }
}
