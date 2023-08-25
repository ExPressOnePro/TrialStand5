<?php

namespace App\Http\Controllers;

use App\Http\Requests\StandReportRequest;
use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandPublishersHistory;
use App\Models\StandReports;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Models\Audit;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;
use function Nette\Utils\removeChildren;
use function Symfony\Component\Console\Style\table;
use Detection\MobileDetect;

class StandController extends Controller{


    // views start
    public function allstands() {
        $user = User::find(Auth::id());
        $congregation_id = $user->congregation_id;
        $accessible_stands_for_dev = Stand::get();
        $congregations = Congregation::where('id', '!=', 1)->get();
        $accessible_stands_for_the_user = DB::table('users')
            ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
            ->select('stands.*')
            ->where('users.id', Auth::id())
            ->where('stands.congregation_id', $congregation_id)
            ->get();

        $mobile_detect = new MobileDetect();
        if ($user->hasRole('Developer')){
            if ($mobile_detect->isMobile()) {
                return view('Mobile.menu.modules.stand.front.hub',
                    ['accessible_stands_for_the_user' => $accessible_stands_for_dev],
                    ['congregations' => $congregations]);
            } else {
                return view('Desktop.stand.index',
                    ['accessible_stands_for_the_user' => $accessible_stands_for_dev],
                    ['congregations' => $congregations]);
            }
        } else {
            if ($mobile_detect->isMobile()) {
                return view('Mobile.menu.modules.stand.front.hub',
                    ['accessible_stands_for_the_user' => $accessible_stands_for_the_user],
                    ['congregations' => $congregations]);
            } else {
                return view('Desktop.stand.index',
                    ['accessible_stands_for_the_user' => $accessible_stands_for_the_user],
                    ['congregations' => $congregations]);
            }
        }
    }
    public function history($id) {
        $standTemplate_id = StandTemplate::where('stand_id',$id)
            ->where('type', '=','current')
            ->first();

        $StandPublishers_id = StandPublishers::where('stand_template_id', $standTemplate_id->id)->get();


        foreach ($StandPublishers_id as $StandPublisher_id) {
            $audits_update[] = Audit::where('auditable_id', $StandPublisher_id->id)
                ->where('auditable_type', 'App\Models\StandPublishers')
                ->where('event', 'updated')
                ->orWhere('event', 'created')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $mobile_detect = new MobileDetect();
        if(empty($audits_update)){
            if ($mobile_detect->isMobile()) {
                return view('Mobile.menu.modules.stand.history');
            } else {
                return view('Desktop.stand.history');
            }
        }
        else{
            if ($mobile_detect->isMobile()) {
                return view('Mobile.menu.modules.stand.history')
                    ->with(['audits' => $audits_update]);
            } else {
                return view('Desktop.stand.history')
                    ->with(['audits' => $audits_update]);
            }
        }

    }
    /*Страница настройки стенда*/
    public function settings($id) {
        $stand_id = Stand::find($id);
        $template = StandTemplate::where('stand_id', $id)
            ->where('type','=','next')
            ->first();

        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();
        $activation = $StandTemplate->activation; // трехзначное число
        $activation_values = explode("-", $activation);
        foreach ($activation_values as $activation_value) {
        }


        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.menu.modules.stand.settings')
                ->with(['stand_id' => $stand_id])
                ->with(['template' => $template])
                ->with(['activation_value' => $activation_value]);
        } else {
            return view('Desktop.stand.settings')
                ->with(['stand_id' => $stand_id])
                ->with(['template' => $template])
                ->with(['activation_value' => $activation_value]);
        }

    }
    /*Страницы текущей и следующей недели стенда*/
    public function currentWeekTable($id) {
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $week_schedule = $StandTemplate->week_schedule;

        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)
            ->get();


        $templates = StandTemplate::with([
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation',
        ])

            ->where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method



        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });

        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.menu.modules.stand.currentWeekTable')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['standPublishers' => $standPublishers]);
        } else {
            return view('Desktop.stand.currentWeekTable')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['standPublishers' => $standPublishers]);
        }
    }
    public function currentWeekTableFront($id) {
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $week_schedule = $StandTemplate->week_schedule;

        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)
            ->get();


        $templates = StandTemplate::with([
            'stand',
            'congregation',
        ])

            ->where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method



        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });

        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.menu.modules.stand.front.currentWeek', compact(
                'StandTemplate',
            'week_schedule',
                'users',
                'stand',
                'standPublishers'));
        } else {
            return view('Desktop.stand.front.currentWeekTable', compact(
                'StandTemplate',
                'week_schedule',
                'users',
                'stand',
                'standPublishers'));
        }
    }
    public function nextWeekTableFront($id) {
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();
        $settings = json_decode($StandTemplate->settings, true);

        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)
            ->get();

        $activation = $settings['activation']; // трехзначное число
        $activation_value = explode("-", $activation);

        $templates = StandTemplate::with([
            'stand',
            'congregation',
        ])

            ->where('stand_id', $id)
            ->where('type', '=','next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method

        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });

        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.menu.modules.stand.front.nextWeek' ,compact(
                'StandTemplate',
            'week_schedule',
                'users',
                'stand',
                'activation_value',
                'standPublishers',
                'activation',
        ));
        } else {
            return view('Desktop.stand.front.currentWeekTable')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['standPublishers' => $standPublishers]);
        }
    }
    public function test($id) {
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $week_schedule = $StandTemplate->week_schedule;

        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)
            ->get();

        $activation = $StandTemplate->activation; // трехзначное число
        $activation_value = explode("-", $activation);

        $templates = StandTemplate::with([
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation',
        ])

            ->where('stand_id', $id)
            ->where('type', '=','current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method



        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });


            return view('Mobile.stand.test')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['activation_value' => $activation_value])
                ->with(['standPublishers' => $standPublishers]);
    }

    public function nextWeekTable($id) {
        $stand = Stand::find($id);
        $users = User::where('congregation_id', $stand->congregation_id)->get();
        $StandTemplate = StandTemplate::where('stand_id', $id)
            ->where('type', '=','next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();
        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();

        $activation = $StandTemplate->activation; // трехзначное число
        $activation_value = explode("-", $activation);

        $templates = StandTemplate::with([
            'stand',
            'standPublishers.user',
            'standPublishers.user2',
            'congregation',
        ])
            ->where('stand_id', $id)
            ->where('type', '=','next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method

        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });

        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.stand.nextWeekTable')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['activation_value' => $activation_value])
                ->with(['standPublishers' => $standPublishers]);
        } else {
            return view('Desktop.stand.nextWeekTable')
                ->with(['StandTemplate' => $StandTemplate])
                ->with(['week_schedule' => $week_schedule])
                ->with(['users' => $users])
                ->with(['stand' => $stand])
                ->with(['activation_value' => $activation_value])
                ->with(['standPublishers' => $standPublishers]);
        }
    }
    public function recordRedactionPage($id){

        $standPublisher = StandPublishers::find($id);
        $standTemplate = StandTemplate::find($standPublisher->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $congregation = Congregation::find($stand->congregation_id);
        $users = User::where('congregation_id', $congregation->id)->get();


        return view ('Mobile.menu.modules.stand.front.components.redaction')
            ->with(['standPublisher' => $standPublisher])
            ->with(['users' => $users])
            ->with(['stand' => $stand]);
    }

    public function recordRecordPage($day, $time, $date, $stand_template_id) {

        $standTemplate = StandTemplate::find($stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $users = User::where('congregation_id', $stand->congregation_id)->get();
        return view ('Mobile.menu.modules.stand.front.components.record', compact(
            'day', 'time',
            'date', 'standTemplate', 'users',
            'stand'));
    }
    public function recordRedactionPageMobile($stand_publishers_id) {

        $standPublisher = StandPublishers::find($stand_publishers_id);
        $standTemplate = StandTemplate::find($standPublisher->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $users = User::where('congregation_id', $stand->congregation_id)->orderby('last_name', 'asc')->get();
        return view ('Mobile.menu.modules.stand.front.components.redaction', compact(
            'standPublisher',
            'users',
            'stand'));

    }
    //views end



    /*Записать первый раз и создать новую запись пользователя на стенд в таблицу publishers*/
    public function NewRecordStand1(Request $request) {

        $user_1 = $request->input('user_1');
        $date = $request->input('date1');
        $day = $request->input('day1');
        $time = $request->input('time1');
        $stand_template_id = $request->input('stand_template_id1');

        $new = StandPublishers::firstOrCreate([
            'date' => $date,
            'day' => $day,
            'time' => $time,
            'stand_template_id' => $stand_template_id,
            'publishers' => json_encode([
                'user_1' => $user_1,
                'user_2' => "",
                'user_3' => "",
                'user_4' => "",
            ]),
        ]);

        $stand_template = StandTemplate::find($stand_template_id);

        $StandPublishersHistory = new StandPublishersHistory();
        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user_1,
            'user_2' => "",
            'user_3' => "",
            'user_4' => "",
        ]);
        $StandPublishersHistory->date = $date;
        $StandPublishersHistory->day = $day;
        $StandPublishersHistory->time = $time;
        $StandPublishersHistory->stand_publishers_id = $new->id;
        $StandPublishersHistory->save();

        if($stand_template->type === 'current') {
            return redirect()->route('currentWeekTableFront', ['id' => $stand_template->stand_id])
                ->with('success','Вы успешно записаны');
        } else {
            return redirect()->route('nextWeekTableFront', ['id' => $stand_template->stand_id])
                ->with('success','Вы успешно записаны');
        }
    }
    public function NewRecordStand2(Request $request) {

        $user_2 = $request->input('user_2');
        $date = $request->input('date2');
        $day = $request->input('day2');
        $time = $request->input('time2');
        $stand_template_id = $request->input('stand_template_id2');
        $new = StandPublishers::firstOrCreate([
            'user_1' => null,
            'user_2' => $user_2,
            'user_3' => null,
            'user_4' => null,
            'date' => $date,
            'day' => $day,
            'time' => $time,
            'stand_template_id' => $stand_template_id,
        ]);

        $StandPublishersHistory = new StandPublishersHistory();
        $StandPublishersHistory->user_1 = null;
        $StandPublishersHistory->user_2 = $user_2;
        $StandPublishersHistory->user_3 = null;
        $StandPublishersHistory->user_4 = null;
        $StandPublishersHistory->date = $date;
        $StandPublishersHistory->day = $day;
        $StandPublishersHistory->time = $time;
        $StandPublishersHistory->stand_publishers_id = $new->id;
        $StandPublishersHistory->save();

        return redirect()->back()->with('success','Вы успешно записаны');
    }

    /*Записать первого пользователя в таблицу с созданным пользователем (1,2)*/
    public function AddPublisherToStand1(Request $request, $id) {

        $user_id1 = $request->input('1_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_2'] != $user_id1) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $user_id1,
                'user_2' => $publishers['user_2'],
                'user_3' => "",
                'user_4' => "",
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $user_id1,
                'user_2' => $publishers['user_2'],
                'user_3' => "",
                'user_4' => "",
            ]);
            $StandPublisher->save();

            if($stand_full->type != 'next') {
                return redirect()->route('currentWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('nextWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }

    public function AddPublisherToStand2(Request $request, $id) {
        $user_id2 = $request->input('2_user_id');
        $StandPublisher = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $StandPublisher->id)->first();
        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        if ($StandPublisher) {
            $publishers = json_decode($StandPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        if($publishers['user_1'] != $user_id2) {

            $StandPublishersHistory->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $user_id2,
                'user_3' => "",
            ]);
            $StandPublishersHistory->save();
            $StandPublisher->publishers = json_encode([
                'user_1' => $publishers['user_1'],
                'user_2' => $user_id2,
                'user_3' => "",
            ]);
            $StandPublisher->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('success','Вы успешно записаны');
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    /*выписаться со стенда*/
    public function recordRedactionDelete1($id, $stand) {
        $standPublisher = StandPublishers::findOrFail($id);
        $standPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($standPublisher->publishers, true);
        $user2Value = $publishers['user_2'] ?? '';
        $standPublishersHistory->publishers = json_encode([
            'user_1' => "",
            'user_2' => $user2Value,
            'user_3' => "",
        ]);
        $standPublishersHistory->save();

        $standPublisher->publishers = $standPublishersHistory->publishers;
        $standPublisher->save();

        $stand_full = StandTemplate::find($standPublisher->stand_template_id);

        $publisher = json_decode($standPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2'])) {
            $standPublisher->delete();
            $standPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);
    }
    public function recordRedactionDelete2($id, $stand) {

        $StandPublisher = StandPublishers::findOrFail($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();

        $publishers = json_decode($StandPublisher->publishers, true);
        $user1Value = $publishers['user_1'] ?? '';
        $StandPublishersHistory->publishers = json_encode([
            'user_1' => $user1Value,
            'user_2' => "",
            'user_3' => "",
        ]);
        $StandPublishersHistory->save();

        $StandPublisher->publishers = $StandPublishersHistory->publishers;
        $StandPublisher->save();

        $stand_full = StandTemplate::find($StandPublisher->stand_template_id);

        $publisher = json_decode($StandPublisher->publishers, true);
        if (empty($publisher['user_1']) && empty($publisher['user_2'])) {
            $StandPublisher->delete();
            $StandPublishersHistory->delete();
        }

        $routeName = ($stand_full->type == 'next') ? 'nextWeekTableFront' : 'currentWeekTableFront';
        return redirect()->route($routeName, ['id' => $stand]);

        /*return redirect()->route('StandTable',  $id);*/
    }
    /*Перезаписать пользователя на стенд*/
    public function recordRedactionChange1(Request $request, $id, $stand) {
        $value = $request->input('1_user_id');
        $StandPublishers = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_2 != $value) {

            $StandPublishersHistory->user_1 = $value;
            $StandPublishersHistory->save();
            $StandPublishers->user_1 = $value;
            $StandPublishers->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id]);
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id]);
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }
    public function recordRedactionChange2(Request $request, $id, $stand) {
        $value = $request->input('2_user_id');
        $StandPublishers = StandPublishers::find($id);
        $StandPublishersHistory = StandPublishersHistory::where('stand_publishers_id', $id)->first();
        $stand_full = StandTemplate::find($StandPublishers->stand_template_id);

        if($StandPublishers->user_2 != $value) {

            $StandPublishersHistory->user_2 = $value;
            $StandPublishersHistory->save();
            $StandPublishers->user_2 = $value;
            $StandPublishers->save();

            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id]);
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id]);
            }
        } else {
            if($stand_full->type == 'next') {
                return redirect()->route('nextWeekTableFront', ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            } else {
                return redirect()->route('currentWeekTableFront',  ['id' => $stand_full->stand_id])
                    ->with('error', 'Пользователь уже записан в выбраное время и дату!');
            }
        }
    }



    /*POST отправка отчета стенда*/
    public function standReportSend(StandReportRequest $request, $id){

        $day = $request->input('day');
        $time = $request->input('time');
        $date = $request->input('date');
        $publications = $request->input('publications');
        $videos = $request->input('videos');
        $return_visits = $request->input('return_visits');
        $bible_studies = $request->input('bible_studies');
        $StandPublishers = StandPublishers::find($id);
        $StandTemplate = StandTemplate::find($StandPublishers->stand_template_id);

        $StandReportsCount = StandReports::where('StandPublishers_id', $id)->count();
        $StandReports = StandReports::with('User')->where('StandPublishers_id', $id)->get();
        $StandReport = StandReports::where('StandPublishers_id', $id)->first();
        if ($StandPublishers->user_id == Auth::id()) {
            if (empty($StandReport->id)) {
                StandReports::create([
                    'day' => $day,
                    'time' => $time,
                    'date' => $date,
                    'user_id' => Auth::id(),
                    'StandPublishers_id' => $id,
                    'publications' => $publications,
                    'videos' => $videos,
                    'return_visits' => $return_visits,
                    'bible_studies' => $bible_studies,
                ]);
            } else {
                StandReports::where('StandPublishers_id', $id)
                    ->update([
                        'day' => $day,
                        'time' => $time,
                        'date' => $date,
                        'user_id' => Auth::id(),
                        'StandPublishers_id' => $id,
                        'publications' => $publications,
                        'videos' => $videos,
                        'return_visits' => $return_visits,
                        'bible_studies' => $bible_studies,
                    ]);
            }
            if ($StandTemplate->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $StandTemplate->stand_id])
                    ->with('success', 'Отчет успешно отправлен');
            } else {
                return redirect()->route('currentWeekTable', ['id' => $StandTemplate->stand_id])
                    ->with('success', 'Отчет успешно отправлен');
            }
        } else {

            if($StandTemplate->type == 'next') {
                return redirect()->route('nextWeekTable', ['id' => $StandTemplate->stand_id])
                    ->with('error', 'Отчет уже был отправлен!');
            } else {
                return redirect()->route('currentWeekTable',  ['id' => $StandTemplate->stand_id])
                    ->with('error', 'Отчет уже был отправлен!');
            }
        }
    }

    /*POST отправка создания нового стенда*/
    public function createNewStand(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required'
        ]);

        $congregation_id = Congregation::
            where('id', $request->input('congregation'))
            ->first();

        $stand = new Stand();
        $stand->name = $request->input('name');
        $stand->location = $request->input('location');
        $stand->congregation_id = $congregation_id->id;
        $stand->save();

        $stand_id = $stand->id;
        $congregation_id_from_stand = $stand->congregation_id;

        $week_schedule_array = [
            1 => [8,9,10,11,12],
            2 => [8,9,10,11,12],
            3 => [8,9,10,11,12],
            4 => [8,9,10,11,12],
            5 => [8,9,10,11,12],
            6 => [8,9,10,11,12],
            7 => [8,9,10,11,12]
        ];
        $settings_array = [
            'activation' => '4-08:00',
            'publishers_at_stand' => '2'
        ];

        $settings_json = json_encode($settings_array);

        $types = ['current', 'next'];

        foreach ($types as $type) {
            StandTemplate::firstOrCreate([
                'type' => $type,
                'week_schedule' => $week_schedule_array,
                'stand_id' => $stand_id,
                'congregation_id' => $congregation_id_from_stand,
                'settings' => $settings_json
            ]);
        }


        return redirect()->route('currentWeekTableFront', $stand_id);
    }
    public function timeUpdateNext(Request $request, $id){

       $stand_id = Stand::find($id);
       $congregation_id = $stand_id->congregation_id;

        StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->update([
                'week_schedule' => $request->schedule,
            ]);

        return redirect()->back();
    }


    public function timeActivation(Request $request, $id){

        $stand_id = Stand::find($id);
        $congregation_id = $stand_id->congregation_id;


        StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->update([
                'activation' => $request->input('day') .'-'.$request->input('time'),
            ]);

        return redirect()->back();
    }



    public function StandTimeNextToCurrent($id) {

        $stand = Stand::find($id);
        $congregation_id = $stand->congregation_id;

        $week_schedule_next = StandTemplate::where('type', 'next')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->first();


        StandTemplate::where('type', 'current')
            ->where('stand_id', $id)
            ->where('congregation_id', $congregation_id)
            ->update([
                'week_schedule' => $week_schedule_next->week_schedule,
            ]);

        return redirect()->back();
    }





}
