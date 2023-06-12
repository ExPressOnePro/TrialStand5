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
        $value = $request->input('role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->update([
                'role_id' => $value,
            ]);

        return redirect()->route('UCRUser', $id);
    }
}
