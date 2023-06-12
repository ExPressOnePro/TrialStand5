<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $user = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        if( $user->congregation_id === 1) {
            return view('guest')
                ->with([
                    'congregation' => $congregation
                ])
                ->with([
                    'congregationRequests' => $congregationRequests
                ]);
        }
        return view('home');
    }

    public function guest() {

        $user = User::find(Auth::id());
        $congregation = Congregation::get();
        $congregationRequests = CongregationRequests::get();


        return view('guest')
            ->with([
            'congregation' => $congregation
            ])
            ->with([
                'congregationRequests' => $congregationRequests
            ]);
    }
}
