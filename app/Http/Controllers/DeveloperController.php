<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermissions;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Facades\Auditor;

class DeveloperController extends Controller{

    public function rolesPermissionsPage() {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('Dev.RolesPermission')
            ->with(['roles' => $roles])
            ->with(['permissions' => $permissions]);
    }
    public function rolesPermissionsChoiceRole($id) {

        $role = Role::find($id);
        $permissions = Permission::get();

        $rolePermission = RolesPermissions::where('role_id', $id)->get();
        /*$permissions = RolesPermissions::where('role_id', $id)->get();*/


        return view('Dev.RolesPermissionChoiceRole')
            ->with(['rolePermission' => $rolePermission])
            ->with(['role' => $role])
            ->with(['permissions' => $permissions]);
    }

    /*Страница создания новой роли, нового права*/
    public function createNewRolePage() {
        /*$userAuditor = Auditor::audit(User::class);
        $userChanges = $userAuditor->count();*/

        $audits = StandPublishers::find(60231);

        return view('Dev.newRole')->with(['audits'=> $audits]);
    }
    public function createNewPermissionPage() {
        return view('Dev.newPermission');
    }

    /*POST отправка создания новой роли, права*/
    public function createNewRole(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->save();

        return redirect()->route('rolesPermissionsChoiceRole', $role->id);

    }
    public function createNewPermission(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $role = new Permission();
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->save();

        return redirect()->route('rolesPermissionsRole');

    }

    /*POST отправка изменения или удаления права для роли*/
    public function rolePermissionAllow(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $RolesPermissions = new RolesPermissions();
        $RolesPermissions->role_id = $id;
        $RolesPermissions->permission_id = $value;
        $RolesPermissions->save();

        return redirect()->route('rolesPermissionsChoiceRole', $id);
    }
    public function rolePermissionDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('roles_permissions')
            ->where('role_id', $id)
            ->where('permission_id', $value)
            ->delete();

        return redirect()->route('rolesPermissionsChoiceRole', $id);
    }

    /*POST отправка изменения или удаления Роли пользователя*/
    public function rolesPermissionsChange(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->route('userCard', $id);
    }
    public function rolesPermissionsDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('userCard', $id);
    }

    public function DevTools(){

        return view('DeveloperTools.main');
    }

    public function devRoleUserUpdate() {
        $users = User::get();
        $rolePublisher = Role::where('name', 'Publisher')->first();
        $roleDeveloper = Role::where('name', 'Developer')->first();
        foreach ($users as $user) {
            UsersRoles::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => $rolePublisher->id
            ]);
        }
        $updatedMe = [
            'user_id' => 1,
            'role_id' => $roleDeveloper->id
        ];

        UsersRoles::where('user_id','1')->update($updatedMe);

        /*$user_id = 1; // ID пользователя, который нужно обновить
        $role_id = 2; // ID роли пользователя, которую нужно обновить

        $updatedData = [
            'column1' => 'новое значение 1',
            'column2' => 'новое значение 2',
            // другие столбцы и их новые значения
        ];

        UsersRoles::where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->update($updatedData);*/


        $usersRoles = UsersRoles::where('role_id', $rolePublisher)->get();
        return redirect()->back();
    }
}
