<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Detection\MobileDetect;
class HomeController extends Controller {
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
        $congregations = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();
        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');

        $standPublishersCount = StandPublishers::
        whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->count();

        $standPublishersCountAll = StandPublishers::
        whereBetween('date', [$startOfWeek, $nextWeekEnd])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->count();

        $user_congregation_id = $user->congregation_id;
        $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();
        $congregationRequestsCountAll = CongregationRequests::count();

        $compact = compact(
            'standPublishersCountAll',
                    'stand',
                    'user_congregation_id',
                    'congregationRequestsCount',
                    'standPublishersCount',
                    'congregationRequestsCountAll',
                    'congregationRequests',
                    'active_day'
        );

        $detect = new MobileDetect;
        if ($detect->isMobile()) { //Mobile
            if( $user->congregation_id === 1) {
                return view('Mobile.guest', ['congregations' => $congregations], ['congregationRequests' => $congregationRequests]);
            } else {
                return view('Mobile.home.home', $compact);
            }
        } else { //Desktop
            if( $user->congregation_id === 1) {
                return view('Mobile.guest', ['congregations' => $congregations], ['congregationRequests' => $congregationRequests]);
            } else {
                return view('Mobile.home.home', $compact);
            }
//            if ($user->congregation_id === 1) {
//                return view('Desktop.guest', ['congregation' => $congregation], ['congregationRequests' => $congregationRequests]);
//            } else {
//                return view('Desktop.home.home',  $compact);
//            }
        }
    }

    public function menu(){

        return view ('Mobile.menu.overview');
    }

    public function guest() {

        $user = User::find(Auth::id());
        $congregations = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();

        $detect = new MobileDetect;
        if ($detect->isMobile()) { //Mobile
            return view('Mobile.guest', compact('congregations', 'congregationRequests'));
        } else { //Desktop

            return view('Mobile.guest', compact('congregations', 'congregationRequests'));

//            return view('Desktop.guest')
//                ->with(['congregations' => $congregations])
//                ->with(['congregationRequests' => $congregationRequests]);
        }

    }

    public function welcome() {

        return view('welcome');
    }
    public function changeLog() {

        return view('changeLog');
    }

    public function recordsWithStandPage(){

        $user = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();

        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        $nextWeekStart = Carbon::now()->addWeek()->startOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');


        $standPublishers = StandPublishers::with('standTemplates')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->get();

        $standPublishersNextWeek = StandPublishers::with('standTemplates')
            ->whereBetween('date', [$nextWeekStart, $nextWeekEnd])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->get();


        $standPublishersCount = StandPublishers::
            whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->count();

        $standPublishersCountNextWeek = StandPublishers::
        whereBetween('date', [$nextWeekStart, $nextWeekEnd])
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->count();

        $compact = compact(
            'standPublishersCountNextWeek',
            'standPublishersNextWeek',
            'standPublishers',
            'stand',
            'standPublishersCount',
            'active_day',
        );

        return view ('Mobile.home.displays.records-with-stand', $compact);
    }
}
