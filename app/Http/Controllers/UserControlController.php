<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserControlController extends Controller
{
    public function pageUserControl() {
        /*$users = User::all();*/
        $roles = new Role;
        /*$users_roles = DB::table('users_roles')->get();*/
        return view('Dev.UserControl', ['roles' => $roles->all()]);
            /*'users' => $users,*/
            /*'data' => $roles->all(),*/
            /*'users_roles' => $users_roles,*/
            /*]);*/
    }

    public function pageRole($id) {

        $roles = new Role;

        $id_role_to_name = Role::where('id', $id)->get();

        $users_name_from_role = DB::table('users')
            ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->select('users.*')
            ->where('users_roles.role_id', $id)
            ->get();


        return view('Dev.UserControlRole')
            ->with([
                /*'data' => $data,*/
            'users_role_id' => $users_name_from_role,
            'roles' => $roles->all(),
            ])
            ->with([
                'id_role_to_name' => $id_role_to_name
            ]);
    }

    public function pageUser($id) {

        $user = new User;

        /*$congregation_id_to_name = Congregation::where('id', $id)->get();*/
        $congregation_id_to_name = DB::table('users')
            ->join('congregations', 'users.id', '=', 'congregations.id')
            ->select('congregations.*')
            ->where('congregations.id', $id)
            ->get();





        /*$users_name_from_role = DB::table('users')
            ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
            ->select('users.*')
            ->where('users_roles.role_id', $id)
            ->get();*/


        return view('Dev.UserControlRoleUser',['user' => [$user->find($id)]], ['citn' => $congregation_id_to_name]);

    }
}
