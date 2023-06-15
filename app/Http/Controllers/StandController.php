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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;
use function Nette\Utils\removeChildren;
use function Symfony\Component\Console\Style\table;

class StandController extends Controller
{

    public function allstands() {

        $user = User::find(Auth::id());
        $congregation_id = $user->congregation_id;
        $accessible_stands_for_the_user = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
            ->select('stands.*')
            ->where('users.id', Auth::id())
            ->where('stands.congregation_id', $congregation_id)
            ->get();
        $accessible_stands_for_dev = DB::table('stands')
            ->get();


        if( $user->congregation_id === 1) {
            return view('guest');
        }
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

        $user = User::get();
        $StandID = Stand::find($id);
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

        return view('stand.table')
            ->with(['templates' => $templates])
            ->with(['active_day' => $active_day])
            ->with(['user' => $user,])
            ->with(['StandID' => $StandID,]);
    }

    /*Страницы текущей и следующей недели стенда*/
    public function currentWeekTable($id) {

        $user = User::get();
        $StandID = Stand::find($id);
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

            $currentMON = date("d.m.Y", time() - (date("N") - 1) * 24 * 60 * 60),
            $currentTUE = date("d.m.Y", time() - (-1 + date("N") - 1) * 24 * 60 * 60),
            $currentWED = date("d.m.Y", time() - (-2 + date("N") - 1) * 24 * 60 * 60),
            $currentTHU = date("d.m.Y", time() - (-3 + date("N") - 1) * 24 * 60 * 60),
            $currentFRI = date("d.m.Y", time() - (-4 + date("N") - 1) * 24 * 60 * 60),
            $currentSAT = date("d.m.Y", time() - (-5 + date("N") - 1) * 24 * 60 * 60),
            $currentSUN = date("d.m.Y", time() - (-6 + date("N") - 1) * 24 * 60 * 60),
            # Понедельник следующей
            $nextMON = date("d.m.Y", time() - (-7 + date("N") - 1) * 24 * 60 * 60),
            $nextTUE = date("d.m.Y", time() - (-8 + date("N") - 1) * 24 * 60 * 60),
            $nextWED = date("d.m.Y", time() - (-9 + date("N") - 1) * 24 * 60 * 60),
            $nextTHU = date("d.m.Y", time() - (-10 + date("N") - 1) * 24 * 60 * 60),
            $nextFRI = date("d.m.Y", time() - (-11 + date("N") - 1) * 24 * 60 * 60),
            $nextSAT = date("d.m.Y", time() - (-12 + date("N") - 1) * 24 * 60 * 60),
            $nextSUN = date("d.m.Y", time() - (-13 + date("N") - 1) * 24 * 60 * 60),
        ];

        return view('stand.currentWeekTable')
            ->with([
                'templates' => $templates,
                'active_day' => $active_day,
            ])
            ->with([
                'user' => $user,
            ])
            ->with([
                'StandID' => $StandID,
            ]);
    }
    public function nextWeekTable($id) {

        $user = User::get();
        $StandID = Stand::find($id);
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

            $currentMON = date("d.m.Y", time() - (date("N") - 1) * 24 * 60 * 60),
            $currentTUE = date("d.m.Y", time() - (-1 + date("N") - 1) * 24 * 60 * 60),
            $currentWED = date("d.m.Y", time() - (-2 + date("N") - 1) * 24 * 60 * 60),
            $currentTHU = date("d.m.Y", time() - (-3 + date("N") - 1) * 24 * 60 * 60),
            $currentFRI = date("d.m.Y", time() - (-4 + date("N") - 1) * 24 * 60 * 60),
            $currentSAT = date("d.m.Y", time() - (-5 + date("N") - 1) * 24 * 60 * 60),
            $currentSUN = date("d.m.Y", time() - (-6 + date("N") - 1) * 24 * 60 * 60),
            # Понедельник следующей
            $nextMON = date("d.m.Y", time() - (-7 + date("N") - 1) * 24 * 60 * 60),
            $nextTUE = date("d.m.Y", time() - (-8 + date("N") - 1) * 24 * 60 * 60),
            $nextWED = date("d.m.Y", time() - (-9 + date("N") - 1) * 24 * 60 * 60),
            $nextTHU = date("d.m.Y", time() - (-10 + date("N") - 1) * 24 * 60 * 60),
            $nextFRI = date("d.m.Y", time() - (-11 + date("N") - 1) * 24 * 60 * 60),
            $nextSAT = date("d.m.Y", time() - (-12 + date("N") - 1) * 24 * 60 * 60),
            $nextSUN = date("d.m.Y", time() - (-13 + date("N") - 1) * 24 * 60 * 60),
        ];

        return view('stand.nextWeekTable')
            ->with([
                'templates' => $templates,
                'active_day' => $active_day,
            ])
            ->with([
                'user' => $user,
            ])
            ->with([
                'StandID' => $StandID,
            ]);
    }

    /*Страницы первой записи пользователей на стенде*/
    public function PageUpdateRecordStandFirst($id) {
        $standPublishers = StandPublishers::find($id);
        $standTemplate = StandTemplate::find($standPublishers->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $congregation = Congregation::find($stand->congregation_id);
        $user = User::where('congregation_id', $congregation->id)->get();

        return view('stand.recordFirst')
            ->with(['stpubl' => $standPublishers,])
            ->with(['user' => $user,])
            ->with(['standname' => $stand->name,]);
    }
    public function PageUpdateRecordStandSecond($id) {
        $standPublishers = StandPublishers::find($id);
        $standTemplate = StandTemplate::find($standPublishers->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $congregation = Congregation::find($stand->congregation_id);
        $user = User::where('congregation_id', $congregation->id)->get();

        return view('stand.recordSecond')
            ->with(['stpubl' => $standPublishers,])
            ->with(['user' => $user,])
            ->with(['standname' => $stand->name,]);
    }

    /*Записать первый раз пользователя на стенд*/
    public function UpdateRecordStandFirst(Request $request, $id) {
        $value = $request->input('usernameID');
        $StandPublishers = StandPublishers::find($id);
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_2 != $value) {

            $StandPublishers->user_1 = $value;
            $StandPublishers->save();

            if($stand_full->type != 'next') {
                return redirect()->route('currentWeekTable', ['id' => $stand_full->stand_id]);
            }
            else {
                return redirect()->route('nextWeekTable',  ['id' => $stand_full->stand_id]);
            }
        }
        else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function UpdateRecordStandSecond(Request $request, $id) {
        $value = $request->input('usernameID');
        $StandPublishers = StandPublishers::find($id);
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_1 != $value) {

            $StandPublishers->user_2 = $value;
            $StandPublishers->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id]);
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id]);
            }
        }
        else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }

    /*выписаться со стенда*/
    public function recordRedactionDelete1($id, $stand) {

        $StandPublishers = StandPublishers::findOrFail($id);
        $StandPublishers->user_1 = null;
        $StandPublishers->save();

        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);


        if($stand_full->type == 'next') {
            return redirect()->route('nextWeekTable', ['id' => $stand]);
        }
        else {
            return redirect()->route('currentWeekTable',  ['id' => $stand]);
        }

        /*return redirect()->route('StandTable',  $id);*/
    }
    public function recordRedactionDelete2($id, $stand) {

        $StandPublishers = StandPublishers::findOrFail($id);
        $StandPublishers->user_2 = null;
        $StandPublishers->save();

        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($stand_full->type == 'next') {
            return redirect()->route('nextWeekTable', ['id' => $stand]);
        }
        else {
            return redirect()->route('currentWeekTable',  ['id' => $stand]);
        }

        /*return redirect()->route('StandTable',  $id);*/
    }

    /*Страница перезаписи пользователей на стенд*/
    public function recordRedactionPage($id){
        $standPublishers = StandPublishers::find($id);
        $standTemplate = StandTemplate::find($standPublishers->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $congregation = Congregation::find($stand->congregation_id);
        $user = User::where('congregation_id', $congregation->id)->get();


        return view ('stand.redaction')
            ->with(['stpubl' => $standPublishers,])
            ->with(['user' => $user,])
            ->with(['stand' => $stand]);
    }

    /*Перезаписать пользователя на стенд*/
    public function recordRedactionChange1(Request $request, $id, $stand) {
        $value = $request->input('1_user_id');
        $StandPublishers = StandPublishers::find($id);
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_2 != $value) {
            $StandPublishers->user_1 = $value;
            $StandPublishers->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id]);
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id]);
            }
        }
        else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function recordRedactionChange2(Request $request, $id, $stand) {
        $value = $request->input('2_user_id');
        $StandPublishers = StandPublishers::find($id);
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_2 != $value) {

            $StandPublishers->user_1 = $value;
            $StandPublishers->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id]);
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id]);
            }
        }
        else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
            else {
                return redirect()->route('currentWeekTable',  ['id' => $stand_full->stand_id])->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }


    public function createNewStandPage() {

        $congregations = Congregation::all();

        return view('stand.create')
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

        $standID = $stand->id;
        $standCongregationID = $stand->congregation_id;

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
        $typeArray = ['current', 'next'];

        foreach ($day_array as $day_arr) {
            foreach ($typeArray as $tA) {
                foreach ($time_array as $time_arr) {
                    StandTemplate::firstOrCreate([
                        'type' => $tA,
                        'day' => $day_arr,
                        'time' => $time_arr,
                        'status' => '1',
                        'stand_id' => $standID,
                        'congregation_id' => $standCongregationID,
                    ]);
                }
            }
        }

        return redirect()->route('StandTable',$standID);

    }

    public function settings($id) {

        $stand_id = Stand::find($id);
        $active_day = StandTemplate::select('day')->distinct()->get();
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

        $template = StandTemplate::where('stand_id', $id)
            ->where('type','=','next')
            ->get();


        return view('stand.settings')
            ->with([
                'stand_id' => $stand_id,
                'template' => $template,
                'active_day' => $active_day
            ]);
    }

    public function timeUpdateNext(Request $request, $id)
    {
        $items = StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->get();

        foreach ($items as $item) {
            $item->status = in_array($item->id, $request->items) ? true : false;
            $item->save();
        }

        return redirect()->back();
    }
    public function timeUpdateNextToCurrent($id) {

        $stand_id = Stand::find($id);
        $congr_id = $stand_id->congregation_id;
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
        foreach ($day_array as $dar) {
            foreach ($time_array as $time_arr) {
                $req1 = StandTemplate::
                where('type', '=', 'next')
                    ->where('day', $dar)
                    ->where('time', $time_arr)
                    ->where('stand_id', $id)
                    ->where('congregation_id', $congr_id)
                    ->get();
                foreach ($req1 as $r1) {
                    $user = StandTemplate::
                    where('type', '=', 'current')
                        ->where('day', $dar)
                        ->where('time', $time_arr)
                        ->where('stand_id',$id)
                        ->where('congregation_id', $congr_id)
                        ->update([
                            'status' => $r1->status,
                        ]);
                }
            }
        }
        return redirect()->back();

        /*$congr_id = $stand_id->congregation_id;
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

        foreach ($day_array as $dar) {
            foreach ($time_array as $time_arr) {
                $valueTemplate = StandTemplate::
                    where('type', 'next')
                    ->where('day', $dar)
                    ->where('time', $time_arr)
                    ->where('stand_id', $stand_id->id)
                    ->where('congregation_id', $congr_id)
                    ->get();
                foreach ($valueTemplate as $vt) {
                    StandTemplate::
                        where('type', 'current')
                        ->where('day', $dar)
                        ->where('time', $time_arr)
                        ->where('stand_id', $stand_id->id)
                        ->where('congregation_id', $congr_id)
                        ->update([
                            'status' => $vt->status,
                        ]);
                }
            }
        }*/
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

    public function ExampleTestVersionOfAddingToPublishersNextWeek() {

        /*пример добавления в базу по основным критериям в таблицу Publishers*/

        $congr_id = Congregation::get();
        $stand_id = Stand::get();
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

        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 1)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -7 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 2)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -8 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 3)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -9 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 4)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -10 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 5)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -11 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 6)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -12 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','next')
                        ->where('day', 7)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -13 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }


    }
    public function ExampleTestVersionOfAddingToPublishersCurrentWeek() {

        /*пример добавления в базу по основным критериям в таблицу Publishers текущей недели*/

        $congr_id = Congregation::get();
        $stand_id = Stand::get();
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

        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 1)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - (      date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 2)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => $currentTUE = date ("Y-m-d", time() - ( -1 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 3)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => $currentTUE = date ("Y-m-d", time() - ( -2 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 4)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => $currentTUE = date ("Y-m-d", time() - ( -3 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 5)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => $currentTUE = date ("Y-m-d", time() - ( -4 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 6)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -5 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($time_array as $time_arr) {
                    $req1 = StandTemplate::where('type', '=','current')
                        ->where('day', 7)
                        ->where('time', $time_arr)
                        ->where('stand_id', $sid->id)
                        ->where('congregation_id', $cid->id)
                        ->get();
                    foreach ($req1 as $r1) {
                        StandPublishers::firstOrCreate([
                            'stand_template_id' => $r1->id,
                            'user_1' => null,
                            'user_2' => null,
                            'date' => date ("Y-m-d", time() - ( -6 + date("N")-1) * 24*60*60),
                        ]);
                    }
                }
            }
        }
    }

    public function test() {

        $thisWeekArray = [
            $thisMon = date('d.m.Y', strtotime('Mon this week')),
            $thisTue = date('d.m.Y', strtotime('Tue this week')),
            $thisWed = date('d.m.Y', strtotime('Wed this week')),
            $thisThu = date('d.m.Y', strtotime('Thu this week')),
            $thisFri = date('d.m.Y', strtotime('Fri this week')),
            $thisSat = date('d.m.Y', strtotime('Sat this week')),
            $thisSun = date('d.m.Y', strtotime('Sun this week')),
        ];
        $nextWeekArray = [
            date ("Y-m-d", time() - ( -7 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - ( -8 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - ( -9 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - (-10 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - (-11 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - (-12 + date("N")-1) * 24*60*60),
            date ("Y-m-d", time() - (-13 + date("N")-1) * 24*60*60),
        ];

        $day_array = [1, 2, 3, 4, 5, 6, 7];
        $nextWeekArray = [
            $nextMon = date('d.m.Y', strtotime('Mon next week')),
            $nextTue = date('d.m.Y', strtotime('Tue next week')),
            $nextWed = date('d.m.Y', strtotime('Wed next week')),
            $nextThu = date('d.m.Y', strtotime('Thu next week')),
            $nextFri = date('d.m.Y', strtotime('Fri next week')),
            $nextSat = date('d.m.Y', strtotime('Sat next week')),
            $nextSun = date('d.m.Y', strtotime('Sun next week')),
        ];
        $congr_id = Congregation::get();
        $stand_id = Stand::get();
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

        foreach ($congr_id as $cid) {
            foreach ($stand_id as $sid) {
                foreach ($day_array as $dar) {
                    foreach ($time_array as $time_arr) {
                        $stand_template_id_next = StandTemplate::
                        where('type', '=', 'next')
                            ->where('day', $dar)
                            ->where('time', $time_arr)
                            ->where('stand_id', $sid->id)
                            ->where('congregation_id', $cid->id)
                            ->get();
                        $stand_template_id_current = StandTemplate::
                        where('type', '=', 'current')
                            ->where('day', $dar)
                            ->where('time', $time_arr)
                            ->where('stand_id', $sid->id)
                            ->where('congregation_id', $cid->id)
                            ->get();
                        foreach ($stand_template_id_next as $stin) {
                            foreach ($stand_template_id_current as $stic) {
                                $stand_publishers_id = StandPublishers::
                                    where('stand_template_id', $stin->id)
                                    ->update([
                                        'stand_template_id', $stic->id
                                    ]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function redactionTime() {

        $timePerDay = StandTemplate::where('stand_id');

        return view('stand.time');
    }

}
