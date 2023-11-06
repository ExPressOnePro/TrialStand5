<?php

namespace App\Http\Controllers\Stand;

use App\Http\Controllers\Controller;
use App\Http\Requests\StandReportRequest;
use App\Models\Congregation;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandPublishersHistory;
use App\Models\StandReports;
use App\Models\StandTemplate;
use App\Models\User;
use App\Models\UsersPermissions;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use function Nette\Utils\removeChildren;
use function Symfony\Component\Console\Style\table;

class StandController extends Controller
{


    // views start
    public function hub()
    {
        $user = User::find(Auth::id());
        $congregation = Congregation::find($user->congregation_id);
        $congregations = Congregation::where('id', '!=', 1)->get();

        if ($user->hasRole('Developer')) {
            $accessible_stands_for_the_user = Stand::get();
        } else {
            $accessible_stands_for_the_user = User::findOrFail(Auth::id())
                ->stands()
                ->where('congregation_id', $congregation->id)
                ->get();
        }
        $accessible_stands_for_the_user_count = User::findOrFail(Auth::id())
            ->stands()
            ->where('congregation_id', $congregation->id)
            ->count();

        $userInfo = json_decode($user->info, true);


        $compact = compact(
            'accessible_stands_for_the_user',
            'congregations',
            'congregation',
            'userInfo',
        );
        $mobile_detect = new MobileDetect();
        $viewName = $mobile_detect->isMobile() ? 'Mobile.menu.modules.stand.hub' : 'Mobile.menu.modules.stand.hub';

        if ($user->hasRole('Developer') || $user->hasRole('HS')) {
            return view($viewName, $compact);
        } elseif ($accessible_stands_for_the_user_count == 1) {
            foreach ($accessible_stands_for_the_user as $one) {
                $stand_id = $one->id;
            }
            return redirect()->route('currentWeekTableFront', $stand_id);
        } else {
            return view($viewName, $compact);
        }
    }

    public function history($id)
    {

        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($AuthUser->congregation_id);
        $stand = Stand::find($id);

        $standTemplates = StandTemplate::where('stand_id', $id)
            ->whereIn('type', ['current', 'next'])
            ->get();

        $templateIds = $standTemplates->pluck('id')->toArray();

        $startDate = Carbon::now()->startOfWeek()->subWeek();
        $standPublishers = StandPublishers::whereIn('stand_template_id', $templateIds)
            ->where('date', '>=', $startDate)
            ->orderBy('date', 'asc')
            ->get();

        $standPublisherIds = $standPublishers->pluck('id');

        $audits = Audit::whereIn('auditable_id', $standPublisherIds)
            ->where('auditable_type', 'App\Models\StandPublishers')
            ->where('event', ['updated', 'created'])
            ->orderByDesc('created_at') // Сортировка по дате убывающим порядком
            ->get();

        $mobile_detect = new MobileDetect();

        $compact = compact('audits');

        if ($AuthUser->hasRole('Developer') || $AuthUser->congregation_id == $stand->congregation_id) {
            $view = 'Mobile.menu.modules.stand.displays.history';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    /*Страница настройки стенда*/
    public function settings($id) {
        $AuthUser = User::query()->find(Auth::id());
        $stand = Stand::query()->find($id);

        $congregation = Congregation::query()->find($stand->congregation_id);


        $usersCongregation = User::query()->where('congregation_id', $congregation->id)->get();

        $template = StandTemplate::query()->where('stand_id', $id)
            ->where('type', '=', 'next')
            ->first();

        $StandTemplate = StandTemplate::query()->with('stand')->where('stand_id', $id)
            ->where('type', '=', 'next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->first();


        $scheduleData = $StandTemplate->week_schedule;
        $settings = json_decode($StandTemplate->settings, true);
        $activation = $settings['activation']; // трехзначное число
        $settings_publishers_at_stand = $settings['publishers_at_stand'];
        $activation_values = explode("-", $activation);
        $daysOfWeek = [
            1 => 'Пн',
            2 => 'Вт',
            3 => 'Ср',
            4 => 'Чт',
            5 => 'Пт',
            6 => 'Сб',
            7 => 'Вс',
        ];
        $permissionsPublishers = Permission::whereIn('name', ['stand.make_entry', 'stand.delete_entry', 'stand.change_entry'])->get();


        $mobile_detect = new MobileDetect();

        $compact = compact(
            'stand',
            'template',
            'daysOfWeek',
            'scheduleData',
            'settings_publishers_at_stand',
            'activation_values',
            'permissionsPublishers',
            'usersCongregation',
        );

        if ($AuthUser->hasRole('Developer') || $AuthUser->congregation_id == $stand->congregation_id) {
            $view = 'Mobile.menu.modules.stand.displays.settings';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }

    }

    public function updatePerm(Request $request)
    {
        $permissions = $request->input('permissions');

        foreach ($permissions as $userId => $userPermissions) {
            $user = User::find($userId);

            // Проверяем, найден ли пользователь
            if ($user) {
                foreach ($userPermissions as $permissionId => $isChecked) {
                    $permission = Permission::find($permissionId);

                    // Проверяем, найдено ли разрешение
                    if ($permission) {
                        $hasPermission = $user->hasPermission($permission->name);

                        // Если состояние чекбокса изменилось, обновляем разрешение
                        if ($isChecked && !$hasPermission) {
                            $user->givePermissionsTo($permission->name);
                        } elseif (!$isChecked && $hasPermission) {
                            $user->deletePermissions($permission->name);
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Разрешения успешно обновлены.');
    }


    public function permUserStand(Request $request)
    {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($AuthUser->congregation_id);

//        if ($AuthUser->hasRole('Developer')) {
//            $usersCongregation = User::where('congregation_id', $congregation->id)->orderby('last_name', 'asc')->get();
//        } else {
            $usersCongregation = User::where('congregation_id', $congregation->id)->orderby('last_name', 'asc')->get();
//        }

        $permissionsPublishers = Permission::whereIn('name', ['module.stand', 'stand.make_entry', 'stand.delete_entry', 'stand.change_entry'])->get();

        $compact = compact(
            'permissionsPublishers',
            'usersCongregation',
        );
        $view = 'Mobile.menu.modules.stand.displays.userspermissionsStand';

        return view($view, $compact);

    }

    /*Страницы текущей и следующей недели стенда*/
    public function allInOneCurrent() {
        $stands = Stand::query()->where('congregation_id', Auth::user()->congregation_id)->get();

        $users = User::where('congregation_id', Auth::user()->congregation_id)->get();

        $StandTemplates = StandTemplate::with('stand', 'congregation')
            ->where('type', '=', 'current')
            ->where('congregation_id', '=', Auth::user()->congregation_id)
            ->groupBy(['stand_id', 'congregation_id'])
            ->get();

        foreach ($StandTemplates as $StandTemplate) {
            $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        }

        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];

        $compact = compact(
            'StandTemplates',
            'users',
            'stands',
            'valuePublishers_at_stand',
            'standPublishers'
        );

        $allowedCongregationIds = $stands->pluck('congregation_id')->toArray();

        if (Auth::user()->hasRole('Developer') || in_array(Auth::user()->congregation_id, $allowedCongregationIds)) {
            $view = 'Mobile.menu.modules.stand.displays.allInOneCurrent';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function allInOneNext() {
        $stands = Stand::query()->where('congregation_id', Auth::user()->congregation_id)->get();

        $users = User::where('congregation_id', Auth::user()->congregation_id)->get();

        $StandTemplates = StandTemplate::with('stand', 'congregation')
            ->where('type', '=', 'next')
            ->where('congregation_id', '=', Auth::user()->congregation_id)
            ->groupBy(['stand_id', 'congregation_id'])
            ->get();

        foreach ($StandTemplates as $StandTemplate) {
            $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        }



        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];

        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];

        $activation = $StandTemplate_settings['activation']; // трехзначное число
        $activation_value = explode("-", $activation);

        $daysOfWeek = [
            1 => trans('text.Понедельник'),
            2 => trans('text.Вторник'),
            3 => trans('text.Среда'),
            4 => trans('text.Четверг'),
            5 => trans('text.Пятница'),
            6 => trans('text.Суббота'),
            7 => trans('text.Воскресенье'),
        ];

        $dayNumber = $activation_value[0];
        $dayName = $daysOfWeek[$dayNumber];
        $currentDateTime = date('N-H:i');
        $activationDateTime = $activation_value[1];

        $compact = compact(
            'StandTemplates',
            'users',
            'stands',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation_value',
            'standPublishers',
            'activation',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
        );

        $allowedCongregationIds = $stands->pluck('congregation_id')->toArray();

        if (Auth::user()->hasRole('Developer') || in_array(Auth::user()->congregation_id, $allowedCongregationIds)) {
            $view = 'Mobile.menu.modules.stand.displays.allInOneNext';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    /*Страницы текущей и следующей недели стенда*/
    public function currentWeekTableFront($id) {

        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($AuthUser->congregation_id);
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        if($AuthUser->hasRole('Developer')){
            $StandTemplate = StandTemplate::where('stand_id', $id)
                ->where('type', '=', 'current')
                ->groupBy(['stand_id', 'congregation_id'])
                ->first();
        } else{
            $StandTemplate = StandTemplate::where('stand_id', $id)
                ->where('type', '=', 'current')
                ->where('congregation_id', '=', $AuthUser->congregation_id)
                ->groupBy(['stand_id', 'congregation_id'])
                ->first();
        }

        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];


        $templates = StandTemplate::with([
            'stand',
            'congregation',
        ])
            ->where('stand_id', $id)
            ->where('type', '=', 'current')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method

        $compact = compact(
            'StandTemplate',
            'week_schedule',
            'users',
            'stand',
            'valuePublishers_at_stand',
            'standPublishers'
        );

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $stand->congregation_id)) {
            $view = 'Mobile.menu.modules.stand.displays.currentWeek';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');


//            return view('Desktop.stand.front.currentWeekTable', compact(
//                'StandTemplate',
//                'week_schedule',
//                'users',
//                'stand',
//                'standPublishers'));
        }
    }

    public function nextWeekTableFront($id)
    {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($AuthUser->congregation_id);
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        if($AuthUser->hasRole('Developer')){
            $StandTemplate = StandTemplate::where('stand_id', $id)
                ->where('type', '=', 'next')
                ->groupBy(['stand_id', 'congregation_id'])
                ->first();
        } else{
            $StandTemplate = StandTemplate::where('stand_id', $id)
                ->where('type', '=', 'next')
                ->where('congregation_id', '=', $AuthUser->congregation_id)
                ->groupBy(['stand_id', 'congregation_id'])
                ->first();
        }

        $settings = json_decode($StandTemplate->settings, true);

        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];

        $activation = $settings['activation']; // трехзначное число
        $activation_value = explode("-", $activation);

        $daysOfWeek = [
            1 => trans('text.Понедельник'),
            2 => trans('text.Вторник'),
            3 => trans('text.Среда'),
            4 => trans('text.Четверг'),
            5 => trans('text.Пятница'),
            6 => trans('text.Суббота'),
            7 => trans('text.Воскресенье'),
        ];

        $dayNumber = $activation_value[0];
        $dayName = $daysOfWeek[$dayNumber];
        $currentDateTime = date('N-H:i');
        $activationDateTime = $activation_value[1];

        $templates = StandTemplate::with([
            'stand',
            'congregation',
        ])
            ->where('stand_id', $id)
            ->where('type', '=', 'next')
            ->groupBy(['stand_id', 'congregation_id'])
            ->get(); // `->get()` because model doesn't have `->map()` method

        $theme = [
//                'background' => '#8496a2',
//                'background-color' => '#8496a2',
            'background' => '#608b93',
            'background-color' => '#6e988f',
        ];
        $templates = $templates->map(static function ($relations) {
            $relations->standPublishers = $relations->standPublishers->keyBy(static function ($standPublishers) {
                return $standPublishers->day . '_' . $standPublishers->time;
            });

            return $relations;
        });

        $var1 = 1;

        $array = [
            'standTemplate' => $var1,

        ];


        $data = compact(
            'StandTemplate',
            'week_schedule',
            'users',
            'stand',
            'theme',
            'activation_value',
            'standPublishers',
            'activation',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
        );

        $mobile_detect = new MobileDetect();
        if ($AuthUser->hasRole('Developer') || $AuthUser->congregation_id == $stand->congregation_id) {
            $view = 'Mobile.menu.modules.stand.displays.nextWeek';
            return view($view, $data);
        } else {
            return view('errors.423Locked');
        }
    }

    public function recordRedactionPage($id)
    {

        $standPublisher = StandPublishers::find($id);
        $standTemplate = StandTemplate::find($standPublisher->stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $congregation = Congregation::find($stand->congregation_id);
        $roleHS = Role::where('name', 'HS')->first();
        $roleDeveloper = Role::where('name', 'Developer')->first();

        $users = User::where('congregation_id', $stand->congregation_id)
            ->where(function ($query) use ($roleHS, $roleDeveloper) {
                $query->whereHas('usersPermissions', function ($subquery) {
                    $subquery->where('permission_id', 1);
                })->orWhereHas('usersRoles', function ($subquery) use ($roleHS, $roleDeveloper) {
                    $subquery->whereIn('role_id', [$roleHS->id, $roleDeveloper->id]);
                });
            })
            ->orderBy('last_name', 'asc')
            ->get();


        return view('Mobile.menu.modules.stand.components.redaction')
            ->with(['standPublisher' => $standPublisher])
            ->with(['users' => $users])
            ->with(['stand' => $stand]);
    }

    public function recordRecordPage($day, $time, $date, $stand_template_id)
    {

        $standTemplate = StandTemplate::find($stand_template_id);
        $stand = Stand::find($standTemplate->stand_id);
        $users = User::where('congregation_id', $stand->congregation_id)->get();
        $moduleStandPermission = Permission::where('name', '=', 'module.stand')->first();

        $usersPermissionStand = UsersPermissions::where('permission_id', $moduleStandPermission->id)->pluck('user_id');
        $roleHS = Role::where('name', 'HS')->first();
        $roleDeveloper = Role::where('name', 'Developer')->first();

        $users = User::where('congregation_id', $stand->congregation_id)
            ->where(function ($query) use ($roleHS, $roleDeveloper) {
                $query->whereHas('usersPermissions', function ($subquery) {
                    $subquery->where('permission_id', 1);
                })->orWhereHas('usersRoles', function ($subquery) use ($roleHS, $roleDeveloper) {
                    $subquery->whereIn('role_id', [$roleHS->id, $roleDeveloper->id]);
                });
            })
            ->orderBy('last_name', 'asc')
            ->get();


        return view('Mobile.menu.modules.stand.components.record', compact(
            'day', 'time',
            'date', 'standTemplate', 'users',
            'stand'));
    }

    public function recordRedactionPageMobile($stand_publishers_id)
    {

        $standPublisher = StandPublishers::find($stand_publishers_id);
        $standTemplate = StandTemplate::find($standPublisher->stand_template_id);
        $settings = json_decode($standTemplate->settings, true);

        if ($standPublisher) {
            $publishers = json_decode($standPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        $stand = Stand::find($standTemplate->stand_id);
        $users = User::where('congregation_id', $stand->congregation_id)
            ->whereHas('UsersPermissions', function ($query) {
                $query->where('permission_id', 1);
            })->orwhereHas('usersroles', function ($query) {
                $query->where('role_id', '=', 'HS');
            })->orderby('last_name', 'asc')
            ->get();
        return view('Mobile.menu.modules.stand.components.redaction', compact(
            'standPublisher',
            'users',
            'settings',
            'publishers',
            'stand'));

    }

    public function reportPage($stand_publishers_id)
    {
        $authorizedUserId = auth()->user()->id;
        $standPublisher = StandPublishers::find($stand_publishers_id);
        $standPublisherJ = json_decode($standPublisher->publishers, true);
        $standPublisherTimes = StandPublishers::where('date', $standPublisher->date)
            ->where(function ($query) use ($standPublisherJ, $authorizedUserId) {
                $query->where('publishers->user_1', $authorizedUserId)
                    ->orWhere('publishers->user_2', $authorizedUserId)
                    ->orWhere('publishers->user_3', $authorizedUserId)
                    ->orWhere('publishers->user_4', $authorizedUserId);
            })
            ->orderBy('time', 'asc')
            ->get();


        $standTemplate = StandTemplate::find($standPublisher->stand_template_id);
        $settings = json_decode($standTemplate->settings, true);

        if ($standPublisher) {
            $publishers = json_decode($standPublisher->publishers, true);
        } else {
            $publishers = [];
        }

        $stand = Stand::find($standTemplate->stand_id);
        $users = User::where('congregation_id', $stand->congregation_id)->orderby('last_name', 'asc')->get();

        $authorizedUserId = auth()->user()->id; // Идентификатор авторизованного пользователя

        $hasUserInPublishers = false;
        foreach (['user_1', 'user_2', 'user_3', 'user_4'] as $userKey) {
            if (isset($publishers[$userKey]) && $publishers[$userKey] == $authorizedUserId) {
                $hasUserInPublishers = true;
                break;
            }
        }

        return view('Mobile.menu.modules.stand.displays.report', compact(
            'standPublisher',
            'standPublisherTimes',
            'users',
            'settings',
            'publishers',
            'stand',
            'hasUserInPublishers'));
    }

    /*POST отправка отчета стенда*/
    public function standReportSend(StandReportRequest $request, $id)
    {

        $day = $request->input('day');
        $time = $request->input('time');
        $date = $request->input('date');
        $publications = $request->input('publications');
        $videos = $request->input('videos');
        $return_visits = $request->input('return_visits');
        $bible_studies = $request->input('bible_studies');

// Проверяем, существует ли уже запись с такими данными
        $existingReport = StandReports::where('user_id', Auth()->user()->id)
            ->whereJsonContains('standPublisherInfo', [
                'StandPublishers_id' => $id,
                'day' => $day,
                'time' => $time,
                'date' => $date,
            ])
            ->first();


        if (!$existingReport) {
            // Создание новой записи
            $standReport = new StandReports();
            $standReport->user_id = Auth()->user()->id;
            $standReport->standPublisherInfo = json_encode([
                'StandPublishers_id' => $id,
                'day' => $day,
                'time' => $time,
                'date' => $date,
            ]);
            $standReport->reportInfo = json_encode([
                'publications' => $publications,
                'videos' => $videos,
                'return_visits' => $return_visits,
                'bible_studies' => $bible_studies,
            ]);
            $standReport->save();
        } else {
            echo 'No';
        }

//            if ($StandTemplate->type == 'next') {
//                return redirect()->route('nextWeekTable', ['id' => $StandTemplate->stand_id])
//                    ->with('success', 'Отчет успешно отправлен');
//            } else {
//                return redirect()->route('currentWeekTable', ['id' => $StandTemplate->stand_id])
//                    ->with('success', 'Отчет успешно отправлен');
//            }
//        } else {
//
//            if($StandTemplate->type == 'next') {
//                return redirect()->route('nextWeekTable', ['id' => $StandTemplate->stand_id])
//                    ->with('error', 'Отчет уже был отправлен!');
//            } else {
//                return redirect()->route('currentWeekTable',  ['id' => $StandTemplate->stand_id])
//                    ->with('error', 'Отчет уже был отправлен!');
//            }
//        }
    }

    public function createNewStand(Request $request)
    {

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
            1 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            2 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            3 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            4 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            5 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            6 => ["08:00", "09:00", "10:00", "11:00", "12:00"],
            7 => ["08:00", "09:00", "10:00", "11:00", "12:00"]
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
}
