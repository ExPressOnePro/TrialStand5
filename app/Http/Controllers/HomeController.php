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
use Detection\MobileDetect;
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
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();
        $start_date = date("Y-m-d", time() - (     date("N") - 1) * 24 * 60 * 60);
        $end_date   = date("Y-m-d", time() - (-6 + date("N") - 1) * 24 * 60 * 60);

//        $standPublishers = StandPublishers::with('standTemplates')
//            ->whereBetween('date', [$start_date, $end_date])
//            ->where('user_1', $user->id)
//            ->orWhere('user_2', $user->id)
//            ->orderBy('date', 'asc')
//            ->get();
//
//        $standPublishersCount = StandPublishers::
//        whereBetween('date', [$start_date, $end_date])
//            ->where('user_1', $user->id)
//            ->orWhere('user_2', $user->id)
//            ->orderBy('date', 'asc')
//            ->count();

        $user_congregation_id = $user->congregation_id;
        $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();
        $congregationRequestsCountAll = CongregationRequests::count();

        $detect = new MobileDetect;
        if ($detect->isMobile()) { //Mobile
            if( $user->congregation_id === 1) {
                return view('Mobile.guest', ['congregation' => $congregation], ['congregationRequests' => $congregationRequests]);
            } else {
                return view('Mobile.home.home', compact(
//                    'standPublishers',
                    'stand',
                    'user_congregation_id',
//                    'standPublishersCount',
                    'congregationRequestsCount',
                    'congregationRequestsCountAll',
                    'congregationRequests',
                    'active_day'));
            }
        } else { //Desktop
            if ($user->congregation_id === 1) {
                return view('Desktop.guest', ['congregation' => $congregation], ['congregationRequests' => $congregationRequests]);
            } else {
                return view('Desktop.home.home', compact(
//                    'standPublishers',
                    'stand',
                    'user_congregation_id',
//                    'standPublishersCount',
                    'congregationRequestsCount',
                    'active_day'));
            }
        }
    }

    public function menu(){

        return view ('Mobile.menu.overview');
    }

    public function guest() {

        $user = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();

        $detect = new MobileDetect;
        if ($detect->isMobile()) { //Mobile
            return view('Mobile.guest')
                ->with(['congregation' => $congregation])
                ->with(['congregationRequests' => $congregationRequests]);
        } else { //Desktop
            return view('Desktop.guest')
                ->with(['congregation' => $congregation])
                ->with(['congregationRequests' => $congregationRequests]);
        }

    }

    public function welcome() {

        return view('welcome');
    }

    public function recordsWithStandPage(){

        $user = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();

        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');


        $standPublishers = StandPublishers::with('standTemplates')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('user_1', $user->id)
            ->orWhere('user_2', $user->id)
            ->where('date', '>=', $startOfWeek)
            ->where('date', '<=', $endOfWeek)
            ->orderBy('date', 'asc')
            ->get();

        $standPublishersCount = StandPublishers::
        whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('date', '>=', $startOfWeek)
            ->where('date', '<=', $endOfWeek)
            ->where('user_1', $user->id)
            ->orWhere('user_2', $user->id)
            ->orderBy('date', 'asc')
            ->count();

        return view ('Mobile.home.records-with-stand')
            ->with(['standPublishers' => $standPublishers])
            ->with(['stand' => $stand])
            ->with(['standPublishersCount' => $standPublishersCount])
            ->with(['active_day' => $active_day]);
    }
}
