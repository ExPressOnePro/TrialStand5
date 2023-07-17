<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermissions;
use App\Models\StandPublishers;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Illuminate\Process\record;

class RolesAndPermissionsController extends Controller{

    public function sortTable(Request $request){
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        $data = User::orderBy($sort, $order)->get();

        return view('Roles and permissions.main', ['data' => $data]);
    }


    public function rolesPermissionsPage() {
        $AuthUser = User::find(Auth::id());

        if ($AuthUser->hasRole('Developer')) {
            $roles = Role::get();
            $permissions = RolesPermissions::with('role', 'permission')
                ->groupBy('permission_id')
                ->get();

            /*$permissions = RolesPermissions::withCount('role')
                ->with('permission')
                ->orderBy('permission', 'asc')
                ->distinct('permission_id')
                ->get();*/

            return view('Roles and permissions.main')
                ->with(['roles' => $roles])
                ->with(['permissions' => $permissions]);
        }

        if ($AuthUser->hasRole('Manager')) {

            $developerRole = Role::where('name', 'Developer')->first();

            /*$permissions = RolesPermissions::with('role', 'permission')
            ->where('role_id', '!=', $developerRole->id)
                ->groupBy('permission_id')
                ->orderBy('role.name')
                ->get();*/

            $permissions = RolesPermissions::withCount('role')
                ->with('permission')
                ->where('role_id', '!=', $developerRole->id)
                ->distinct('permission_id')
                ->get();

            $roles = Role::where('name', '!=', 'Developer')->get();


            return view('Roles and permissions.main', [
                'roles' => $roles,
                'permissions' => $permissions
            ]);
        }
        else {
            return view('errors.423Locked');
        }

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

        return redirect()->route('rolesPermissionsPage');
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

        return redirect()->route('rolesPermissionsPage', $id);
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
}
