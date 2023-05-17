<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StandController extends Controller
{

    public function allstands() {

        $user = User::find(Auth::id());


        $accessible_stands_for_the_user = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
            ->select('stands.*')
            ->where('users.id', Auth::id())
            ->get();

        $accessible_stands_for_dev = DB::table('stands')
            ->get();

        if ($user->hasRole('Developer')){
            return view('stand.index',
                ['accessible_stands_for_the_user' => $accessible_stands_for_dev]);
        }
        else {
            return view('stand.index',
                ['accessible_stands_for_the_user' => $accessible_stands_for_the_user]);
        }

    }

    public function tables($id) {

    $templates = StandTemplate::with(
        'stand',
        'standPublishers.user',
        'standPublishers.user2',
        'congregation'
    )
        ->where('stand_id', '=', $id)
        ->orderBy('day')
        ->get();


    $active_day = StandTemplate::select('day')->distinct()->get();
    $ardates = [

        $currentMON = date ("d.m.Y", time() - (      date("N")-1) * 24*60*60),
        $currentTUE = date ("d.m.Y", time() - ( -1 + date("N")-1) * 24*60*60),
        $currentWED = date ("d.m.Y", time() - ( -2 + date("N")-1) * 24*60*60),
        $currentTHU = date ("d.m.Y", time() - ( -3 + date("N")-1) * 24*60*60),
        $currentFRI = date ("d.m.Y", time() - ( -4 + date("N")-1) * 24*60*60),
        $currentSAT = date ("d.m.Y", time() - ( -5 + date("N")-1) * 24*60*60),
        $currentSUN = date ("d.m.Y", time() - ( -6 + date("N")-1) * 24*60*60),
        # Понедельник следующей
        $nextMON = date ("d.m.Y", time() - ( -7 + date("N")-1) * 24*60*60),
        $nextTUE = date ("d.m.Y", time() - ( -8 + date("N")-1) * 24*60*60),
        $nextWED = date ("d.m.Y", time() - ( -9 + date("N")-1) * 24*60*60),
        $nextTHU = date ("d.m.Y", time() - (-10 + date("N")-1) * 24*60*60),
        $nextFRI = date ("d.m.Y", time() - (-11 + date("N")-1) * 24*60*60),
        $nextSAT = date ("d.m.Y", time() - (-12 + date("N")-1) * 24*60*60),
        $nextSUN = date ("d.m.Y", time() - (-13 + date("N")-1) * 24*60*60),
    ];

    return view('stand.table')
        ->with([
            'templates' => $templates,
            'active_day' => $active_day,
            'ardates' => $ardates,
        ]);
}

    public function settings($id) {
        $standID = Stand::where('id', $id)->get();
        $active_day = StandTemplate::select('day')->distinct()->get();
        $time_array = [
            '00:00',
            '01:00',
            '02:00',
            /*'03:00',
            '04:00',
            '05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',*/
        ];

        $template = StandTemplate::where('stand_id', $id)
            ->where('type','=','next')
            ->get();


        return view('stand.settings')
            ->with([
                'standID' => $standID,
                'template' => $template,
                'active_day' => $active_day
            ]);
    }

    public function createNewStandPage() {

        $congregations = Congregation::all();

        return view('stand.settings')
            ->with([
                'congregations' => $congregations,
            ]);

    }

    public function createNewStand(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required'
        ]);

        $congrId = DB::table('congregations')
            ->where('name', $request->input('congregation'))
            ->value('id');

        $stand = new Stand();
        $stand->name = $request->input('name');
        $stand->location = $request->input('location');
        $stand->congregation_id = $congrId;
        $stand->save();

        $createdStandId = DB::table('stands')
            ->where('name', $request->input('name'))
            ->value('id');

        $time_array = [
            '00:00',
            '01:00',
            '02:00',
            '03:00',
            '04:00',
            '05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',
        ];
        $day_array = [1, 2, 3, 4, 5, 6, 7];
        $req1 = DB::table('stand_templates')->get();
        $typeArray = ['last', 'current', 'next'];

        foreach ($day_array as $day_arr) {
            foreach ($typeArray as $tA) {
                foreach ($time_array as $time_arr) {
                    foreach ($req1 as $r1) {
                        StandTemplate::firstOrCreate([
                            'type' => $tA,
                            'day' => $day_arr,
                            'time' => $time_arr,
                            'status' => '1',
                            'stand_id' => $createdStandId,
                            'congregation_id' => $congrId,
                        ]);
                    }
                }
            }
        }
        $this->tables();
    }

    public function time(Request $request) {

        var_dump($request);

    }

    public function test12() {
        $test = StandTemplate::with(
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation'
        );

        $test2 = DB::table('stand_templates')
            ->select('times_range')
            ->get();


        $stt = new StandTemplate();
        $srtf = StandTemplate::where('type', 'current')->get();



        foreach ($srtf as $stid) {

            $test4 = $stid->times_range;

            $test3 = "DB::insert(insert into stands_publishers (stand_template_id, time)
            VALUES (
            $stid->id,
            $test4
            )";

            dd($test3);
        }
    }

    public function record($art)
    {

        return view('stand.record')
            ->with([
                'art' => $art
            ]);
    }

    public function test_insert_temp() /*пример добавления в базу по основным*/
    {
        $congr_id = DB::table('stands')->get();
        $time_array = [
            '00:00',
            '01:00',
            '02:00',
            '03:00',
            '04:00',
            '05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',
        ];
        $day_array = [1, 2, 3, 4, 5, 6, 7];
        $req1 = DB::table('stand_templates')->get();

        foreach ($congr_id as $con_id) {
            $stand_id_by_cong = DB::table('stands')
                ->where('congregation_id', $con_id->id)
                ->get();
            foreach ($stand_id_by_cong as $sta_id) {
                foreach ($day_array as $day_arr) {
                    foreach ($time_array as $time_arr) {
                        foreach ($req1 as $r1) {
                            $insert_template = StandTemplate::firstOrCreate([
                                    'day' => $day_arr,
                                    'time' => $time_arr,
                                    'status' => '1',
                                    'stand_id' => $sta_id->id,
                                    'congregation_id' => $con_id->id,
                                ]);
                        }
                    }
                }
            }
        }


    }

    public function test() {

        $nextWeekArray1 = [
        $thisMon = date('d.m.Y', strtotime('Mon this week')),
        $thisTue = date('d.m.Y', strtotime('Tue this week')),
        $thisWed = date('d.m.Y', strtotime('Wed this week')),
        $thisThu = date('d.m.Y', strtotime('Thu this week')),
        $thisFri = date('d.m.Y', strtotime('Fri this week')),
        $thisSat = date('d.m.Y', strtotime('Sat this week')),
        $thisSun = date('d.m.Y', strtotime('Sun this week')),
            ];
        $nextWeekArray2 = [
            $nextMon = date('d.m.Y', strtotime('Mon next week')),
            $nextTue = date('d.m.Y', strtotime('Tue next week')),
            $nextWed = date('d.m.Y', strtotime('Wed next week')),
            $nextThu = date('d.m.Y', strtotime('Thu next week')),
            $nextFri = date('d.m.Y', strtotime('Fri next week')),
            $nextSat = date('d.m.Y', strtotime('Sat next week')),
            $nextSun = date('d.m.Y', strtotime('Sun next week')),
        ];

        $day_array = [1, 2, 3, 4, 5, 6, 7];

        foreach ($day_array as $item) {

            $get_by_current = DB::table('stand_templates')
                ->where('day', '=', $item)
                ->where('type', '=', 'current')
                ->where('stand_id', '=', 2)
                ->get();

            foreach ($get_by_current as $gbc) {

                $record = StandTemplate::find($gbc->id);
                $record->status = DB::table('stand_templates')
                    ->where('day', '=', $gbc->day)
                    ->where('time', '=', $gbc->time)
                    ->where('type', '=', 'next')
                    ->where('stand_id', '=', 2)
                    ->value('status');
                $record->save();
            }
        }
    }

    public function redactionTime() {

        $timePerDay = StandTemplate::where('stand_id');

        return view('stand.time');
    }

    public function testasd() {
        /*for ($i = 1; $i < count($request->en_answer); $i++) {
            $answers[] = [
                'stand_template_id' => StandTemplate::get()->id,
                'en_answer' => $request->en_answer[$i],
                'question_id' => $request->question_id[$i]
            ];
        }
        dd($answers);
        StandPublishers::insert($answers);
        return redirect('submitted')->with('status', 'Your answers successfully submitted');*/
    }
}
