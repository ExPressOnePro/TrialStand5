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
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $location = $request->input('location');
        $stand = Stand::findOrFail($id);
        $stand->name = $name;
        $stand->location = $location;
        $stand->save();
    }

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

        $viewName2 = 'BootstrapApp.Modules.stand.hub';
        $viewName = 'Modules.stand.hub';

        if ($user->hasRole('Developer') || $user->hasRole('HS')) {
            return view($viewName, $compact);
        } elseif ($accessible_stands_for_the_user_count == 1) {
            foreach ($accessible_stands_for_the_user as $one) {
                $stand_id = $one->id;
            }
            return redirect()->route('stand.current', $stand_id);
        } else {
            return view($viewName, $compact);
        }
    }
    public function hub2()
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

        $viewName2 = 'BootstrapApp.Modules.stand.hub';
        $viewName = 'Modules.stand.hub';

        if ($user->hasRole('Developer') || $user->hasRole('HS')) {
            return view($viewName2, $compact);
        } elseif ($accessible_stands_for_the_user_count == 1) {
            foreach ($accessible_stands_for_the_user as $one) {
                $stand_id = $one->id;
            }
            return redirect()->route('stand.current', $stand_id);
        } else {
            return view($viewName2, $compact);
        }
    }

    public function history($id)
    {

        $AuthUser = User::find(Auth::id());
        $stand = Stand::find($id);

        $standTemplates = StandTemplate::where('stand_id', $id)
            ->whereIn('type', ['current', 'next'])
            ->get();

        $templateIds = $standTemplates->pluck('id')->toArray();

        $startDate = Carbon::now()->startOfWeek()->subWeek();
        $standPublisherIds = StandPublishers::whereIn('stand_template_id', $templateIds)
            ->where('date', '>=', $startDate)
            ->orderBy('date', 'desc')
            ->pluck('id');

        $createdAudits = Audit::whereIn('event', ['created'])
            ->whereIn('auditable_id', $standPublisherIds)
            ->where('auditable_type', 'App\Models\StandPublishers')
            ->orderByDesc('created_at')
            ->get();

        $updatedAudits = Audit::whereIn('event', ['updated'])
            ->whereIn('auditable_id', $standPublisherIds)
            ->where('auditable_type', 'App\Models\StandPublishers')
            ->orderByDesc('created_at')
            ->get();

        $audits = $createdAudits->merge($updatedAudits);

        $compact = compact('audits');

        if ($AuthUser->hasRole('Developer') || $AuthUser->congregation_id == $stand->congregation_id) {
            $view = 'Modules.stand.displays.history';
            $view2 = 'BootstrapApp.Modules.stand.displays.history';
            return view($view2, $compact);
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
        $activation = $settings['activation'];
        $settings_publishers_at_stand = $settings['publishers_at_stand'];
        $activation_values = explode("-", $activation);

        $daysOfWeek = [
            1 => trans('text.Понедельник'),
            2 => trans('text.Вторник'),
            3 => trans('text.Среда'),
            4 => trans('text.Четверг'),
            5 => trans('text.Пятница'),
            6 => trans('text.Суббота'),
            7 => trans('text.Воскресенье'),
        ];

        $permissionsPublishers = Permission::whereIn('name', ['stand.make_entry', 'stand.delete_entry', 'stand.change_entry'])->get();

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
            $view = 'Modules.stand.displays.settings';
            $view2 = 'BootstrapApp.Modules.stand.displays.settings';
            return view($view2, $compact);
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

    public function updatePerm1(Request $request)
    {
        $userId = $request->input('user_id');
        $permissionId = $request->input('permission_id');
        $isChecked = $request->input('is_checked');

        // Проверка, существует ли связь пользователя с разрешением
        $userPermission = UsersPermissions::where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->first();

        if ($isChecked) {
            // Если чекбокс отмечен и связь не существует, создаем новую
            if (!$userPermission) {
                UsersPermissions::create([
                    'user_id' => $userId,
                    'permission_id' => $permissionId,
                ]);
            }
        } else {
            // Если чекбокс не отмечен и связь существует, удаляем ее
            if ($userPermission) {
                $userPermission->delete();
            }
        }

        return response()->json(['success' => true]);
    }

    public function permUserStand(Request $request, $id)
    {
        $AuthUser = User::find(Auth::id());
        $congregation_id = Stand::where('id', $id)->pluck('congregation_id');

//        if ($AuthUser->hasRole('Developer')) {
//            $usersCongregation = User::where('congregation_id', $congregation->id)->orderby('last_name', 'asc')->get();
//        } else {
            $usersCongregation = User::where('congregation_id', $congregation_id)->orderby('last_name', 'asc')->get();
//        }

        $permissionsPublishers = Permission::whereIn('name', ['module.stand', 'stand.make_entry', 'stand.delete_entry'])->get();

        $compact = compact(
            'permissionsPublishers',
            'usersCongregation',
        );
        $view = 'Modules.congregation.displays.permissionsUsers';

        return view($view, $compact);
    }


//    public function table(Request $request, $id){
//
//        $AuthUser = User::find(Auth::id());
//        $stand = Stand::find($id);
//
//        $users = User::where('congregation_id', $stand->congregation_id)->get();
//
//        $standType = $request->is('*current*') ? 'current' : 'next';
//
//        $query = StandTemplate::where('stand_id', $id)
//            ->where('type', '=', $standType);
//
//
//        if (!$AuthUser->hasRole('Developer')) {
//            $query->where('congregation_id', '=', $AuthUser->congregation_id);
//        }
//
//
//        $StandTemplate = $query->groupBy(['stand_id', 'congregation_id'])->first();
//
//        $week_schedule = $StandTemplate->week_schedule;
//
//
//        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->first();
//
//        $standPublisher = StandPublishers::with('standTemplates.stand')->find($standPublishers->id);
//
//
//        if (!$standPublisher) {
//            return response()->json(['error' => 'StandPublisher not found'], 404);
//        }
//
//        //$standTemplate = StandTemplate::find($standPublisher->stand_template_id);
//        $settings = json_decode($standTemplate->settings, true);
//
//        if ($standPublisher) {
//            $publishers = json_decode($standPublisher->publishers, true);
//        } else {
//            $publishers = [];
//        }
//
//        $startOfCurrentWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
//        $standPublishersEx = StandPublishers::query()->where('date', '>=', $startOfCurrentWeek)->get();
//
//        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
//        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];
//        $user = User::find(Auth::id());
//        $userInfo = json_decode($user->info, true);
//
//        $activation = $StandTemplate_settings['activation']; // трехзначное число
//        $activation_value = explode("-", $activation);
//
//        $daysOfWeek = [
//            1 => trans('text.Понедельник'),
//            2 => trans('text.Вторник'),
//            3 => trans('text.Среда'),
//            4 => trans('text.Четверг'),
//            5 => trans('text.Пятница'),
//            6 => trans('text.Суббота'),
//            7 => trans('text.Воскресенье'),
//        ];
//
//        $dayNumber = $activation_value[0];
//        $dayName = $daysOfWeek[$dayNumber];
//        $currentDateTime = date('N-H:i');
//        $activationDateTime = $activation_value[1];
//
//        $compact = compact(
//            'StandTemplate',
//            'week_schedule',
//            'users',
//            'stand',
//            'settings',
//            'userInfo',
//            'valuePublishers_at_stand',
//            'standPublishers',
//            'standPublishersEx',
//            'activation',
//            'activation_value',
//            'dayName',
//            'valuePublishers_at_stand',
//            'currentDateTime',
//            'activationDateTime',
//        );
//
//        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $stand->congregation_id)) {
//            $view = 'Modules.stand.displays.weekly';
//            return view($view, $compact);
//        } else {
//            return view('errors.423Locked');
//        }
//    }

    public function table(Request $request, $id){
        $AuthUser = User::find(Auth::id());
        $stand = Stand::find($id);

        $users = User::where('congregation_id', $stand->congregation_id)->get();

        $standType = $request->is('*current*') ? 'current' : 'next';

        $query = StandTemplate::where('stand_id', $id)
            ->where('type', '=', $standType);

        if (!$AuthUser->hasRole('Developer')) {
            $query->where('congregation_id', '=', $AuthUser->congregation_id);
        }

        $StandTemplate = $query->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $settings = json_decode($StandTemplate->settings, true);
        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];
        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);

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
            'StandTemplate',
            'week_schedule',
            'users',
            'stand',
            'settings',
            'userInfo',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation',
            'activation_value',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
        );

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $stand->congregation_id)) {
            $view = 'Modules.stand.displays.weekly_schedule';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function table2(Request $request, $id) {

        $AuthUser = User::find(Auth::id());
        $stand = Stand::find($id);
        $users = User::query()
            ->where('congregation_id', $stand->congregation_id)
            ->get(['id', 'first_name', 'last_name']);

        $canEdit = auth()->user()->can('stand.make_entry');

        $standType = $request->is('*current*') ? 'current' : 'next';

        $query = StandTemplate::where('stand_id', $id)
            ->where('type', '=', $standType);

        if (!$AuthUser->hasRole('Developer')) {
            $query->where('congregation_id', '=', $AuthUser->congregation_id);
        }

        $StandTemplate = $query->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $settings = json_decode($StandTemplate->settings, true);
        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];
        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);

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
            'StandTemplate',
            'week_schedule',
            'users',
            'stand',
            'settings',
            'userInfo',
            'canEdit',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation',
            'activation_value',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
        );

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $stand->congregation_id)) {
            $view = 'BootstrapApp.Modules.stand.displays.weekly_schedule';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function tableJson(Request $request, $id) {

        $AuthUser = User::find(Auth::id());
        $stand = Stand::find($id);
        $users = User::query()
            ->where('congregation_id', $stand->congregation_id)
            ->get(['id', 'first_name', 'last_name']);

        $canEdit = auth()->user()->can('stand.make_entry');

        $standType = $request->is('*current*') ? 'current' : 'next';

        $query = StandTemplate::where('stand_id', $id)
            ->where('type', '=', $standType);

        if (!$AuthUser->hasRole('Developer')) {
            $query->where('congregation_id', '=', $AuthUser->congregation_id);
        }

        $StandTemplate = $query->groupBy(['stand_id', 'congregation_id'])
            ->first();

        $settings = json_decode($StandTemplate->settings, true);
        $week_schedule = $StandTemplate->week_schedule;
        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        $StandTemplate_settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];
        $user = User::find(Auth::id());
        $userInfo = json_decode($user->info, true);

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
            'StandTemplate',
            'week_schedule',
            'users',
            'stand',
            'settings',
            'userInfo',
            'canEdit',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation',
            'activation_value',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
        );

        return response()->json(['data' => [$compact]], 200);
//        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $stand->congregation_id)) {
//            $view = 'BootstrapApp.Modules.stand.displays.weekly_schedule';
//            return view($view, $compact);
//        } else {
//            return view('errors.423Locked');
//        }
    }

    public function aioTable(Request $request,){
        $AuthUser = User::find(Auth::id());
        $stands = Stand::query()->where('congregation_id', Auth::user()->congregation_id)->get();

        $users = User::where('congregation_id', Auth::user()->congregation_id)->get();
        $user = User::find(Auth::id());

        $standType = $request->is('*current*') ? 'current' : 'next';

        $StandTemplates = StandTemplate::with('stand', 'congregation')
            ->where('type', '=', $standType)
            ->where('congregation_id', '=', $AuthUser->congregation_id)
            ->groupBy(['stand_id', 'congregation_id'])
            ->get();

        foreach ($StandTemplates as $StandTemplate) {
            $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        }

        $StandTemplate_settings = json_decode($StandTemplate->settings, true);

        $settings = json_decode($StandTemplate->settings, true);
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

        $userInfo = json_decode($user->info, true);

        $compact = compact(
            'StandTemplates',
            'StandTemplate',
            'users',
            'stands',
            'settings',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation_value',
            'standPublishers',
            'activation',
            'week_schedule',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
            'userInfo',
        );

        $allowedCongregationIds = $stands->pluck('congregation_id')->toArray();

        if (Auth::user()->hasRole('Developer') || in_array(Auth::user()->congregation_id, $allowedCongregationIds)) {
            $view = 'Modules.stand.displays.weekly_schedule';
            $view2 = 'BootstrapApp.Modules.stand.displays.weekly_schedule';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function aioTable2(Request $request,){
        $AuthUser = User::find(Auth::id());
        $stands = Stand::query()->where('congregation_id', Auth::user()->congregation_id)->get();

        $users = User::where('congregation_id', Auth::user()->congregation_id)->get();
        $user = User::find(Auth::id());

        $standType = $request->is('*current*') ? 'current' : 'next';

        $StandTemplates = StandTemplate::with('stand', 'congregation')
            ->where('type', '=', $standType)
            ->where('congregation_id', '=', $AuthUser->congregation_id)
            ->groupBy(['stand_id', 'congregation_id'])
            ->get();

        foreach ($StandTemplates as $StandTemplate) {
            $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
        }

        $StandTemplate_settings = json_decode($StandTemplate->settings, true);

        $settings = json_decode($StandTemplate->settings, true);
        $valuePublishers_at_stand = $StandTemplate_settings['publishers_at_stand'];

        $week_schedule = $StandTemplate->week_schedule;
//        $standPublishers = StandPublishers::where('stand_template_id', $StandTemplate->id)->get();
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

        $userInfo = json_decode($user->info, true);

        $compact = compact(
            'StandTemplates',
            'StandTemplate',
            'users',
            'stands',
            'settings',
            'valuePublishers_at_stand',
            'standPublishers',
            'activation_value',
            'standPublishers',
            'activation',
            'week_schedule',
            'dayName',
            'valuePublishers_at_stand',
            'currentDateTime',
            'activationDateTime',
            'userInfo',
        );

        $allowedCongregationIds = $stands->pluck('congregation_id')->toArray();

        if (Auth::user()->hasRole('Developer') || in_array(Auth::user()->congregation_id, $allowedCongregationIds)) {
            $view = 'Modules.stand.displays.weekly_schedule';
            $view2 = 'BootstrapApp.Modules.stand.displays.weekly_schedule';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function recordCreate($day, $time, $date, $stand_template_id)
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


        $compact = compact('day',
            'time',
            'date',
            'standTemplate',
            'users',
            'stand');

        return view('Modules.stand.displays.record', $compact);
    }

    public function recordRedaction($stand_publishers_id)
    {

        $standPublisher = StandPublishers::with('standTemplates.stand')->find($stand_publishers_id);

        if (!$standPublisher) {
            return response()->json(['error' => 'StandPublisher not found'], 404);
        }

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

        return view('Modules.stand.displays.record_redaction', compact(
            'standPublisher',
            'users',
            'settings',
            'publishers',
            'stand'));

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
