<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller{

    public function allUsersPage() {

        $users = User::with('usersroles.role')->get();

        $role = UsersRoles::with('role')->get();


        return view('users.users')
            ->with(['users' => $users,])
            ->with(['role' => $role,]);
    }
    public function userCard($id) {
        $user = User::find(Auth::id());
        if($user->hasRole('Developer')) {
            $roles = Role::get();
            $permissions = Permission::get();
        } else{
            $permissions = Permission::where('name', 'LIKE', 'Stand%')->get();
            $roles = Role::get();
        }
        $user = User::find($id);

        $congregation_id_to_name = DB::table('users')
            ->join('congregations', 'users.id', '=', 'congregations.id')
            ->where('congregations.id', $id)
            ->get();

        if($user->hasRole('Developer')) {
            return view('users.card')
                ->with(['user' => $user])
                ->with(['roles' => $roles])
                ->with(['permissions' => $permissions])
                ->with(['citn' => $congregation_id_to_name]);
        } else{
            return view('users.card')
                ->with(['user' => $user])
                ->with(['roles' => $roles])
                ->with(['permissions' => $permissions])
                ->with(['citn' => $congregation_id_to_name]);

        }
    }
    public function permissionAllow(Request $request, $id) {
        $value = $request->input('allow_permission_id');
        $user = new UsersPermissions();
        $user->user_id = $id;
        $user->permission_id = $value;
        $user->save();

        return redirect()->back();
    }
    public function permissionDelete(Request $request, $id) {
        $value = $request->input('delete_permission_id');
        DB::table('users_permissions')
            ->where('user_id', $id)
            ->where('permission_id', $value)
            ->delete();

        return redirect()->back();
    }
    public function roleAllow(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->back();
    }
    public function roleDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->back();
    }

    public function personalMonthlyReport(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('userCard', $id);
    }

}
