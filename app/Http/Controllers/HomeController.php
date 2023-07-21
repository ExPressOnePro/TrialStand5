<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                ->with(['congregation' => $congregation])
                ->with(['congregationRequests' => $congregationRequests]);
        }
        else {

            $stand = Stand::where('congregation_id', $user->congregation_id)->get();
            $active_day = StandTemplate::select('day')->distinct()->get();

            $start_date = date("Y-m-d", time() - (     date("N") - 1) * 24 * 60 * 60);
            $end_date   = date("Y-m-d", time() - (-6 + date("N") - 1) * 24 * 60 * 60);


            $standPublishers = StandPublishers::with(
                'standTemplates'
            )
                ->whereBetween('date', [$start_date, $end_date])
                ->where('user_1', $user->id)
                ->orWhere('user_2', $user->id)
                ->orderBy('date', 'asc')
                ->get();




            $standPublishersCount = StandPublishers::
                whereBetween('date', [$start_date, $end_date])
                ->where('user_1', $user->id)
                ->orWhere('user_2', $user->id)
                ->orderBy('date', 'asc')
                ->count();

            $user_congregation_id = $user->congregation_id;
            $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();

            return view('home')
                ->with(['standPublishers' => $standPublishers])
                ->with(['stand' => $stand])
                ->with(['user_congregation_id' => $user_congregation_id])
                ->with(['standPublishersCount' => $standPublishersCount])
                ->with(['congregationRequestsCount' => $congregationRequestsCount])
                ->with(['active_day' => $active_day]);
        }

    }

    public function guest() {

        $user = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();
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
