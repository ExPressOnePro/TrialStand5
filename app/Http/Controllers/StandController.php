<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StandController extends Controller
{

    public function allstands() {
        $user = User::find(1);

        $accessible_stands_for_the_user = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
            ->select('stands.*')
            ->where('users.id', Auth::id())
            ->get();

        $accessible_stands_for_dev = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
            ->select('stands.*')
            ->get();

        if ($user = User::find(1)){
            return view('stand.index',
                ['asftu' => $accessible_stands_for_dev]);
        }
        else {
            return view('stand.index',
                ['asftu' => $accessible_stands_for_the_user]);
        }

    }

    public function tables($id) {
        $templates = StandTemplate::with(
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation'
        )
            ->where('type', '=', 'current')
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



        /*SELECT id FROM `stand_templates` WHERE type = "current" AND day = "(SELECT DISTINCT day FROM `stand_templates`)"

        (SELECT time FROM `stand_templates` WHERE type = "current" AND day = "(SELECT DISTINCT day FROM `stand_templates`)")

        DB::table('users')->insert([
    ['email' => 'picard@example.com', 'votes' => 0],
    ['email' => 'janeway@example.com', 'votes' => 0],
]);



        /*$enable_time = StandTemplate::select('time')
            ->where('')
            ->get();*/

        /*$groupdays = DB::table('Stand_Templates')
            /*->select('day')*/
        /*->where('status', 'active')*/
        /*->distinct()
        ->count('day');

    dd($groupdays);*/


        /*$active_day = StandTemplate::distinct()->count(['day']);*/


        /*$groupdays123 = json_decode($groupdays, true);*/


        /*$active_day = StandTemplate::select('day')
            ->where('status', 'active')
            ->where('day', $groupdays)
            ->get();

        dd($active_day);*/


        /*$active_time = StandTemplate::get();
           /* dd($templates);*/


        return view('stand.table')
            ->with([
                'templates' => $templates,
                'active_day' => $active_day,
                'ardates' => $ardates,
            ]);
    }


    /*public function record($time_range) {

        dd($time_range);
    }*/

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

        /*->join('stands', 'stands.congregation_id', '=', 'users.congregation_id' )
        ->select('stands.')
        ->where('type', 'current')
        ->get();*/

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
                                    'type' => 'current',
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

        $active = DB::table('stand_templates')
            ->distinct()
            ->pluck('day');



        foreach ($active as $item) {

            $get_by_active = DB::table('stand_templates')
                ->select('id', 'time')
                ->where('type', '=', 'current')
                ->where('day', '=', $item)
                ->get();
            foreach ($get_by_active as $gba) {

                $ins = DB::table('stands_publishers')
                    ->insert([
                    'stand_template_id' => $gba->id,
                    'period' => $gba->time,
                    'user_1' => null,
                    'user_2' => null,
                    'date' =>'2023-05-15 00:00:00',
                ]);

            }
        }



        /*$ins = StandPublishers::insert([
            ['stand_template_id' => $get_id_by_active],
            ['period' => (DB::table('stand_templates')
                ->select('time')
                ->where('type', '=', 'current')
                ->where('day', '=', StandTemplate::select('day')->distinct()->get()))],
            ['user_1' => null],
            ['user_2' => null],
            ['date' =>'2023-05-08 11:35:25'],
        ]);

        dd($ins);*/



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
