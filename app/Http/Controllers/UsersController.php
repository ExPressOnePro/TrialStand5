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

        $user = User::get();
        return view('users.users')
            ->with([
                'user' => $user
            ]);
    }

    public function userCard($id) {

        $user = User::where('id', $id)->get();

        $congregation_id_to_name = DB::table('users')
            ->join('congregations', 'users.id', '=', 'congregations.id')
            ->select('congregations.*')
            ->where('congregations.id', $id)
            ->get();

        return view('users.card')
            ->with(['user' => $user])
            ->with(['citn' => $congregation_id_to_name]);
    }

}
