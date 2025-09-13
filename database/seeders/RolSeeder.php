<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{

    public function run()
    {
        $permission = Permission::firstOrCreate(['name' => 'SISEP']);
        $roles      = [
            'Administrador General',
            'Tecnico Acopio',
            'Tecnico Inventario',
            'Recepcion',
            'Cajero',
        ];
        foreach ($roles as $rolName) {
            $role = Role::firstOrCreate(['name' => $rolName]);
            $role->givePermissionTo($permission);
        }
        DB::table('rol_users')->updateOrInsert(
            ['rol_id' => 1, 'usuario_id' => 1],
            ['rol_id' => 1, 'usuario_id' => 1]
        );
        DB::table('rol_users')->updateOrInsert(
            ['rol_id' => 1, 'usuario_id' => 2],
            ['rol_id' => 1, 'usuario_id' => 2]
        );
        DB::table('usuario_sucursals')->updateOrInsert(
            ['user_id' => 1, 'sucursal_id' => 1],
        );
        DB::table('usuario_sucursals')->updateOrInsert(
            ['user_id' => 2, 'sucursal_id' => 1],
        );

        foreach ([1, 2] as $id) {
            $usuario = User::find($id);
            if ($usuario) {
                $usuario->password = bcrypt('123456');
                $usuario->save();
                $usuario->givePermissionTo('SISEP');
                $usuario->syncRoles('Administrador General');
            }
        }
    }
}
