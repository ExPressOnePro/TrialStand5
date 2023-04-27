<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserControlController extends Controller
{
    public function pageUserControl()
    {
            $users = User::all();
            $roles = Role::all();
            $users_roles = DB::table('users_roles')->get();


        return view('Dev.UserControl')->with([
            'users' => $users,
            'roles' => $roles,
            'users_roles' => $users_roles
            ]);
    }
    public function myAction(Request $request)
    {
        $data = $request->all(); // получение данных формы
        // обработка данных, сохранение в базу и т.д.
        return response()->json(['data' => $data]); // отправка ответа клиенту
    }
}
