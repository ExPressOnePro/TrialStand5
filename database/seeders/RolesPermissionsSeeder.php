<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermissions;
use App\Models\User;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionIds = Permission::pluck('id');
        $permission1 = Permission::where('name', '=','Stand-Open stand table')->first();
        $permission2 = Permission::where('name', '=','Stand-Entry in table')->first();
        $permission3 = Permission::where('name', '=','module.stand')->first();
        $permission4 = Permission::where('name', '=','module.contacts')->first();

        $users_pamanteni = User::where('congregation_id', 2)->get();
        $users_dacia = User::where('congregation_id', 3)->get();

        $rolePublishers = Role::where('name', '=', 'Publisher')->first();

//        foreach($users_pamanteni as $user_pamanteni){
//            UsersPermissions::create([
//                'user_id' => $user_pamanteni,
//                'permission_id' => $permission1,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_pamanteni,
//                'permission_id' => $permission2,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_pamanteni,
//                'permission_id' => $permission3,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_pamanteni,
//                'permission_id' => $permission4,
//            ]);
//            UsersRoles::create([
//                'user_id' => $user_pamanteni,
//                'role_id' => $rolePublishers,
//            ]);
//        }
//
//        foreach($users_dacia as $user_dacia){
//            UsersPermissions::create([
//                'user_id' => $user_dacia,
//                'permission_id' => $permission1,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_dacia,
//                'permission_id' => $permission2,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_dacia,
//                'permission_id' => $permission3,
//            ]);
//            UsersPermissions::create([
//                'user_id' => $user_dacia,
//                'permission_id' => $permission4,
//            ]);
//            UsersRoles::create([
//                'user_id' => $user_dacia,
//                'role_id' => $rolePublishers,
//            ]);
//        }


        $roleId = 1; // Идентификатор роли, для которой выполняется присвоение разрешений

        // Создаем записи в таблице roles_permissions
        foreach ($permissionIds as $permissionId) {
            RolesPermissions::create([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
        }


    }
}
