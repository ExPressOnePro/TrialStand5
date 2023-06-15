<?php

namespace App\Http\Controllers;

use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller{

    public function rolesPermissionsPage() {

        return view('Dev.RolesPermission');
    }

    public function rolesPermissionsChange(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->route('UCRUser', $id);
    }

    public function rolesPermissionsDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('UCRUser', $id);
    }
}
