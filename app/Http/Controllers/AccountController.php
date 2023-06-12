<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller{


    public function account($id){

        $user = User::find($id);

        return view('users.card')
            ->with([
            'user' => $user, ]);
    }

    public function notifications(){
        return view('notifications');
    }

}
