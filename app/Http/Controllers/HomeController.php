<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\MeetingSchedules;
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
    protected $userValuesResult;

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

        $AuthUser = User::query()->find(Auth::id());
        $user = User::find(Auth::id());
        $congregations = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();
        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $userInfo = json_decode($user->info, true);

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



        if($user->hasRole('Developer') ) {
            $congregationRequestsCount = CongregationRequests::count();
        } else {
            $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();
        }
        $compact = compact(
            'standPublishersCountAll',
            'user',
            'stand',
            'user_congregation_id',
            'congregationRequestsCount',
            'standPublishersCount',
            'congregationRequests',
            'userInfo',
            'active_day'
        );

        if ($user->congregation_id === 1) {
            return view('BootstrapApp.Modules.code', ['user' => $user]);
        } else {
            return $this->home();
        }

    }

    public function guest() {
        $user = User::find(Auth::id());
        return view('BootstrapApp.layouts.guest', compact('user'));
    }


    public function homeContent($content){
        switch ($content) {
            case 'main':
                $html = $this->getMainContent();
                return response()->json(['content' => $html]);
                break;
            case 'menu':
                $html = $this->getMenuContent();
                return response()->json(['content' => $html]);
                break;
        }
        return response()->json(['content' => $content]);
    }

    private function getMainContent()
    {
        $user = User::find(Auth::id());
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();
        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $userInfo = json_decode($user->info, true);

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

        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        $nextWeekStart = Carbon::now()->addWeek()->startOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $standPublishersToday = StandPublishers::with('standTemplates')
            ->where('date', $startOfWeek)
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->get();


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

        $standPublishersCount = $standPublishers->count();

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


        $standPublishersCountNextWeek = $standPublishersNextWeek->count();

        if($user->hasRole('Developer') ) {
            $congregationRequestsCount = CongregationRequests::count();
        } else {
            $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();
        }


        $meetingSchedules = MeetingSchedules::query()
            ->where('congregation_id', $user->congregation_id)
            ->where('week_from', '>=', Carbon::now()->startOfWeek()->format('Y-m-d'));

        if(!auth()->user()->can('schedule.redaction')) {
            $meetingSchedules->where('published', '=', 1);
        }

        $meetingSchedules = $meetingSchedules->orderBy('week_from', 'desc')->get();

        $viewed = false; // Инициализируем флаг

        foreach ($meetingSchedules as $meetingSchedule) {
            $viewedByUsersType = json_decode($meetingSchedule->viewed_by_users, true);
            if ($viewedByUsersType === null) {
                $viewedByUsers = [];
            } else {
                $viewedByUsers = json_decode($meetingSchedule->viewed_by_users, true);
            }

            if (is_array($viewedByUsers) && in_array(Auth::id(), $viewedByUsers)) {
                $viewed = true; // Если хотя бы один объект имеет true, устанавливаем флаг в true и выходим из цикла
                break;
            }
        }

        $compact = compact(

            'standPublishersCountAll',
            'user',
            'userInfo',
            'standPublishersToday',
            'stand',
            'user_congregation_id',
            'congregationRequestsCount',
            'standPublishersCount',
            'userInfo',
            'active_day',
            'standPublishersCountNextWeek',
            'standPublishersNextWeek',
            'standPublishers',
            'nextWeekStart',
            'standPublishersCount',
            'viewed',
        );

        return view ('BootstrapApp.Modules.home.partials.main', $compact)->render();
    }
    private function getMenuContent()
    {
        return view ('BootstrapApp.Modules.home.partials.menu')->render();
    }


    public function menu(){
        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);

        $compact = compact('userInfo');

        $view1 = 'Mobile.menu.overview';
        $view2 = 'BootstrapApp.Modules.menu';

        return view ($view1, $compact);
    }

    public function menu2(){
//        $user = User::find(Auth::id());
//        $userInfo = json_decode($user->info, true);
//
//        $compact = compact('userInfo');

        $view1 = 'Mobile.menu.overview';
        $view2 = 'BootstrapApp.Modules.menu';

        return view ($view2);
    }
    public function menu3(){
        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);

        $compact = compact('userInfo');

        $view1 = 'Mobile.menu.overview';
        $view2 = 'BootstrapApp.Modules.menu2';

        return view ($view2, $compact);
    }

    public function home(){
        $user = User::find(Auth::id());
        $user_congregation_id = $user->congregation_id;
        $compact = compact('user_congregation_id');
        return view ('BootstrapApp.Modules.home.home');
    }

    public function home2(){

        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);
        $congregations = Congregation::where('id', '>', 1)->get();
        $congregationRequests = CongregationRequests::get();
        $stand = Stand::where('congregation_id', $user->congregation_id)->get();
        $active_day = StandPublishers::select('day')->distinct()->get();
        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $userInfo = json_decode($user->info, true);

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

        $startOfWeek = now()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        $nextWeekStart = Carbon::now()->addWeek()->startOfWeek()->format('Y-m-d');
        $nextWeekEnd = Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $standPublishersToday = StandPublishers::with('standTemplates')
            ->where('date', $startOfWeek)
            ->where(function ($query) use ($user) {
                $query->where('publishers->user_1', $user->id)
                    ->orWhere('publishers->user_2', $user->id)
                    ->orWhere('publishers->user_3', $user->id)
                    ->orWhere('publishers->user_4', $user->id);
            })
            ->orderBy('date', 'asc')
            ->get();


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

        $standPublishersCount = $standPublishers->count();

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


        $standPublishersCountNextWeek = $standPublishersNextWeek->count();

        if($user->hasRole('Developer') ) {
            $congregationRequestsCount = CongregationRequests::count();
        } else {
            $congregationRequestsCount = CongregationRequests::where('congregation_id', $user_congregation_id)->count();
        }


        $meetingSchedules = MeetingSchedules::query()
            ->where('congregation_id', $user->congregation_id)
            ->where('week_from', '>=', Carbon::now()->startOfWeek()->format('Y-m-d'));

        if(!auth()->user()->can('schedule.redaction')) {
            $meetingSchedules->where('published', '=', 1);
        }

        $meetingSchedules = $meetingSchedules->orderBy('week_from', 'desc')->get();

        $viewed = false; // Инициализируем флаг

        foreach ($meetingSchedules as $meetingSchedule) {
            $viewedByUsersType = json_decode($meetingSchedule->viewed_by_users, true);
            if ($viewedByUsersType === null) {
                $viewedByUsers = [];
            } else {
                $viewedByUsers = json_decode($meetingSchedule->viewed_by_users, true);
            }

            if (is_array($viewedByUsers) && in_array(Auth::id(), $viewedByUsers)) {
                $viewed = true; // Если хотя бы один объект имеет true, устанавливаем флаг в true и выходим из цикла
                break;
            }
        }




        $compact = compact(

            'standPublishersCountAll',
            'user',
            'userInfo',
            'standPublishersToday',
            'stand',
            'user_congregation_id',
            'congregationRequestsCount',
            'standPublishersCount',
            'congregationRequests',
            'userInfo',
            'active_day',
            'standPublishersCountNextWeek',
            'standPublishersNextWeek',
            'standPublishers',
            'nextWeekStart',
            'standPublishersCount',
            'viewed',
        );

        return view ('BootstrapApp.Modules.home.home2', $compact);
    }

    public function welcome() {

        return view('welcome');
    }

    public function changeLog() {

        return view('ChangeLog.changeLog');
    }

    public function helpfaq() {

        return view('BootstrapApp.Modules.help');
    }

    public function recordsWithStandPage(){

        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);
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
            'userInfo',
            'standPublishersCount',
            'active_day',
        );

        return view ('Mobile.home.displays.records-with-stand', $compact);
    }
}
