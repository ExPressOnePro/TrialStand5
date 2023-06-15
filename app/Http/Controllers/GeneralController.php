<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {


    public function ads(){

        return view('general.ads');
    }

    public function profile() {

        $id = Auth::id();
        $user = User::find($id);


        return view('general.profile')
            ->with(['user' => $user]);
    }
}
