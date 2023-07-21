<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller{

    public function allUsersPage() {

        $user = User::with(
            'usersroles.role'
        )
            ->get();

        $role = UsersRoles::with(
            'role'
        )
            ->get();


        return view('users.users')
            ->with([
                'user' => $user,
            ])
        ->with([
            'role' => $role,
        ]);
    }
    public function userCard($id) {

        $role = Role::get();
        $user = User::find($id);

        $congregation_id_to_name = DB::table('users')
            ->join('congregations', 'users.id', '=', 'congregations.id')
            ->where('congregations.id', $id)
            ->get();

        return view('users.card')
            ->with(['user' => $user])
            ->with(['role' => $role])
            ->with(['citn' => $congregation_id_to_name]);
    }
    public function roleAllow(Request $request, $id) {
        $value = $request->input('allow_role_id');
        $user = new UsersRoles();
        $user->user_id = $id;
        $user->role_id = $value;
        $user->save();

        return redirect()->route('userCard', $id);
    }
    public function roleDelete(Request $request, $id) {
        $value = $request->input('delete_role_id');
        DB::table('users_roles')
            ->where('user_id', $id)
            ->where('role_id', $value)
            ->delete();

        return redirect()->route('userCard', $id);
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
