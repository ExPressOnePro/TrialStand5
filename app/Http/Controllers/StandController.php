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
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;
use function Nette\Utils\removeChildren;
use function Symfony\Component\Console\Style\table;

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

        return view('stand.table')
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

    public function recordRedactionPage($id){

        $stpubl = StandPublishers::find($id);
        $user = User::get();
        $stid = StandTemplate::find($stpubl->stand_template_id);
        $stname = Stand::find($stid->stand_id);


        return view ('stand.redaction')
            ->with(['stpubl' => $stpubl,])
            ->with(['user' => $user,])
            ->with(['stand' => $stname,]);;
    }

    public function recordRedactionChange1(Request $request, $id, $stand) {

        $value = $request->input('1_user_id');

        $StandPublishers = StandPublishers::find($id);
        $StandPublishers->user_1 = $value;
        $StandPublishers->save();

        return redirect()->route('StandTable',  ['id' => $stand]);
    }
    public function recordRedactionChange2(Request $request, $id, $stand) {

        $value = $request->input('2_user_id');

        $StandPublishers = StandPublishers::find($id);
        $StandPublishers->user_2 = $value;
        $StandPublishers->save();

        return redirect()->route('StandTable',  ['id' => $stand]);
    }
    public function recordRedactionDelete1($id, $stand) {

        $StandPublishers = StandPublishers::findOrFail($id);
        $StandPublishers->user_1 = null;
        $StandPublishers->save();

        $id = $stand;

        return redirect()->route('StandTable',  $id);
    }
    public function recordRedactionDelete2($id, $stand) {

        $StandPublishers = StandPublishers::findOrFail($id);
        $StandPublishers->user_2 = null;
        $StandPublishers->save();

        $id = $stand;

        return redirect()->route('StandTable',  $id);
    }

    public function PageUpdateRecordStandFirst($id) {
    $stpubl = StandPublishers::find($id);
    $user = User::get();
    $stid = StandTemplate::find($stpubl->stand_template_id);
    $stname = Stand::find($stid->stand_id);

    return view('stand.recordFirst')
        ->with(['stpubl' => $stpubl,])
        ->with(['user' => $user,])
        ->with(['standname' => $stname->name,]);
    }
    public function PageUpdateRecordStandSecond($id) {
        $stpubl = StandPublishers::find($id);
        $user = User::get();
        $stid = StandTemplate::find($stpubl->stand_template_id);
        $stname = Stand::find($stid->stand_id);

        return view('stand.recordSecond')
            ->with(['stpubl' => $stpubl,])
            ->with(['user' => $user,])
            ->with(['standname' => $stname->name,]);
    }
    public function UpdateRecordStandFirst(Request $request, $id) {
        $stpubl = StandPublishers::find($id);
        $stid = StandTemplate::find($stpubl->stand_template_id);
        $value = $request->input('usernameID');
        DB::table('stands_publishers')
            ->where('id', $id)
            ->update([
                'user_1' => $value,
            ]);

        return redirect()->route('StandTable', $stid->stand_id)->with('success', 'Ваша запись добавлена');

    }
    public function UpdateRecordStandSecond(Request $request, $id) {
        $stpubl = StandPublishers::find($id);
        $stid = StandTemplate::find($stpubl->stand_template_id);
        $value = $request->input('usernameID');
        DB::table('stands_publishers')
            ->where('id', $id)
            ->update([
                'user_2' => $value,
            ]);

        return redirect()->route('StandTable', $stid->stand_id)->with('success', 'Ваша запись добавлена');

    }

    public function settings($id) {

        $standID = Stand::where('id', $id)->get();
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
                'standID' => $standID,
                'template' => $template,
                'active_day' => $active_day
            ]);
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
        $typeArray = ['last', 'current', 'next'];

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

    public function timeUpdate( Request $request)
    {
        $items = StandTemplate::all();

        foreach ($items as $item) {
            $item->status = in_array($item->id, $request->items) ? true : false;
            $item->save();
        }
        /*$items = StandTemplate::whereIn('id', $request->input('items'))->get();

        foreach ($items as $item) {
            $item->status = !$item->status;
            $item->save();
        }*/

        /*$items = StandTemplate::whereIn('id', $request->input('active'))->get();
        foreach ($items as $item) {
            $item->status = true;
            $item->save();
        }*/

        /*foreach ($request->input('active', []) as $tempId => $active) {
            $template = StandTemplate::findOrFail($tempId);
            $template->status = (bool) $active;
            $template->save();
        }*/

        /*foreach($request->input('task_id') as $key => $id) {
            $task = StandTemplate::find($id);
            $task->status = in_array($id, $request->input('task_enabled', []));
            $task->save();
        }*/

        /*foreach ($request->input('item') as $id => $value) {
            $item = Item::findOrFail($id);
            $item->status = $value == '1'; // 'on' - это значение, которое отправляется в случае, если флажок отмечен,
            // в противном случае пользователь не отправляет значение флажка, только
            // ключ.
            $item->save();
        }*/

        /*foreach ($request->all() as $key => $value) {
            if (strpos($key, 'item') === 0) {
                $item_id = substr($key, 4);
                $item = StandTemplate::findOrFail($item_id);
                $item->status = $value == 1;
                $item->save();
            }
        }*/

        return redirect()->back()->with('success', 'Изменения сохранены');

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
