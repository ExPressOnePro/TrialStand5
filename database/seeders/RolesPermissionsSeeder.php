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

        $permission1 = Permission::where('name', '=','Stand-Open stand table')->first();
        $permission2 = Permission::where('name', '=','Stand-Entry in table')->first();
        $permission3 = Permission::where('name', '=','module.stand')->first();
        $permission4 = Permission::where('name', '=','module.contacts')->first();

        $users_pamanteni = User::where('congregation_id', 2)->get();
        $users_dacia = User::where('congregation_id', 3)->get();

        $rolePublishers = Role::where('name', '=', 'Publisher')->first();



        // Получите необходимые разрешения
        $permissions = Permission::whereIn('name', [
            'module.stand',
            'stand.make_entry',
            'stand.delete_entry',
            'stand.change_entry'
        ])->get();

        // Получите всех пользователей с congregation_id равным 2 или 3
        $users = User::whereIn('congregation_id', [2, 3])->get();

        // Получите роль "Publisher"
        $rolePublishers = Role::where('name', '=', 'Publisher')->first();

        // Пройдитесь по каждому пользователю и присвойте им разрешения и роль
        foreach ($users as $user) {
            // Присвойте разрешения пользователю
            foreach ($permissions as $permission) {
                $userPermission = new UsersPermissions();
                $userPermission->user_id = $user->id;
                $userPermission->permission_id = $permission->id;
                $userPermission->save();
            }
        }

//        foreach($users_pamanteni as $user_pamanteni){
//
//            $rp1 = new UsersPermissions();
//            $rp1->user_id = $user_pamanteni;
//            $rp1->permission_id = $permission1;
//            $rp1->save();
//
//            $rp2 = new UsersPermissions();
//            $rp2->user_id = $user_pamanteni;
//            $rp2->permission_id = $permission2;
//            $rp2->save();
//
//            $rp3 = new UsersPermissions();
//            $rp3->user_id = $user_pamanteni;
//            $rp3->permission_id = $permission3;
//            $rp3->save();
//
//            $rp4 = new UsersPermissions();
//            $rp4->user_id = $user_pamanteni;
//            $rp4->permission_id = $permission4;
//            $rp4->save();
//
//            $ur1 = new UsersRoles();
//            $ur1->user_id = $user_pamanteni;
//            $ur1->role_id = $rolePublishers;
//            $ur1->save();
//
//        }
//
//        foreach($users_dacia as $user_dacia){
//            $rp11 = new UsersPermissions();
//            $rp11->user_id = $user_dacia;
//            $rp11->permission_id = $permission1;
//            $rp11->save();
//
//            $rp22 = new UsersPermissions();
//            $rp22->user_id = $user_dacia;
//            $rp22->permission_id = $permission2;
//            $rp22->save();
//
//            $rp33 = new UsersPermissions();
//            $rp33->user_id = $user_dacia;
//            $rp33->permission_id = $permission3;
//            $rp33->save();
//
//            $rp44 = new UsersPermissions();
//            $rp44->user_id = $user_dacia;
//            $rp44->permission_id = $permission4;
//            $rp44->save();
//
//            $ur11 = new UsersRoles();
//            $ur11->user_id = $user_dacia;
//            $ur11->role_id = $rolePublishers;
//            $ur11->save();
//        }


        $roleId = 1; // Идентификатор роли, для которой выполняется присвоение разрешений
        $permissionIds = Permission::pluck('id');
        // Создаем записи в таблице roles_permissions
        foreach ($permissionIds as $permissionId) {
            RolesPermissions::create([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
        }


    }
}
