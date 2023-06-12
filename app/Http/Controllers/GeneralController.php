<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller {


    public function ads(){

        return view('general.ads');
    }

    public function profile() {
        return view('general.profile');
    }
}
