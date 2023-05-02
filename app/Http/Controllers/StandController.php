<?php

namespace App\Http\Controllers;

use App\Models\StandTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StandController extends Controller
{
    public function index() {


        $accessible_stands_for_the_user = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id' )
            ->select('stands.*')
            ->where('users.id', Auth::id())
            ->get();


        $templates = StandTemplate::with(
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation'
       )
            ->where('type','==', 'current')
            ->orderBy('day')
            ->get();

        return view('stand.index', ['templates' => $templates], ['asftu'=> $accessible_stands_for_the_user]);
    }

    public function record($time_range) {

        dd($time_range);
    }

    public function table($id) {


        return view('stand.table');
    }
}
