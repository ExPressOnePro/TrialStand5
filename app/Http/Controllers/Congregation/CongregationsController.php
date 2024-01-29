<?php

namespace App\Http\Controllers\Congregation;

use App\Http\Controllers\Controller;
use App\Models\Astart;
use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\CongregationsPermissions;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Stand;
use App\Models\User;
use App\Models\UsersGroups;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class CongregationsController extends Controller {

    public function hub() {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();

        $compact = compact('congregation');
        if($AuthUser->hasRole('Developer')){
            $view = 'Mobile.menu.modules.congregation.hub';
            $view2 = 'BootstrapApp.Modules.congregations.hub';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }

    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $congregation = new Congregation();
        $congregation->name = $request->input('name');
        $congregation->info = json_encode("");
        $congregation->save();

        return redirect()->back();
    }

    public function view($id) {

        // Coutns
        $countUsers = User::where('congregation_id', $id)->count();
        $countGroups = Group::where('congregation_id', $id)->count();
        $countStands = Stand::where('congregation_id', $id)->count();
        $countCongregationsPermissions = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $id)
            ->count();


        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        $lastWeek = Carbon::now()->subWeek();
        $usersActiveCount = User::where(DB::raw('info->>"$.last_login"'), '>=', $lastWeek)->where('congregation_id', $id)->count();
        $usersCongregationCount = User::where('congregation_id', $id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->count();

// Проверка на пустые значения и присвоение 0
        $usersActiveCount = !empty($usersActiveCount) ? $usersActiveCount : 0;
        $usersCongregationCount = !empty($usersCongregationCount) ? $usersCongregationCount : 0;

        // Проверка на ноль перед делением
        if ($usersCongregationCount !== 0) {
            $usersActiveCountPercent = ($usersActiveCount / $usersCongregationCount) * 100;
        } else {
            $usersActiveCountPercent = 0; // Если $usersCongregationCount равно нулю
        }

        if ($usersRoleOverseers->isEmpty()) {
            $countOverseers = '0';
        } else {
            foreach ($usersRoleOverseers as $usersRoleOverseer) {
                $countOverseers[] = User::where('congregation_id', $id)
                    ->where('id', $usersRoleOverseers->user_id)
                    ->count();
            }
        }
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($id);
        $Developer = Role::where('slug', '=', 'Developer')->first();
        $Developers_id = UsersRoles::where('role_id', $Developer->id)->get();
        $permission_Overseers = Permission::where('name', 'like', 'Developer.User manager%')->get();

        $groups = Group::with('responsibleUserId')
            ->where('congregation_id', $id)
            ->get();

        foreach ($groups as $group) {
            $users_groups[] = UsersGroups::with('User')->where('group_id', $group->id)->get();
        }

        if($permission_Overseers->isEmpty()) {
            $permission_Overseer = '0';
        } else {
            foreach ($permission_Overseers as $permission_Oversee) {
                $permission_Overseer[] = UsersPermissions::with('User')
                    ->where('permission_id', $permission_Oversee->id)
                    ->get();
            }
        }

        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();
        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();

        $users = User::where('congregation_id', $id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        $connectedModules = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $id)
            ->get();

        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->count();

        $metrics = [
            [
                'title' => 'Количество возвещателей',
                'route' => route('congregation.publishers', $id),
                'count' => $usersCongregationCount,
                'percent' => null,
            ],
//            [
//                'title' => 'Активных за неделю',
//                'route' =>  route('congregation.ActiveUsersPerWeek', $id),
//                'count' => $usersActiveCount,
//                'percent' => $usersActiveCountPercent,
//            ],
            [
                'title' => 'Работающих стендов',
                'route' => route('congregation.stands', $id),
                'count' => $countStands,
                'percent' => null, // Здесь процент не указан
            ],
            [
                'title' => 'Подключено модулей',
                'route' => route('congregation.modules', $id),
                'count' => $countCongregationsPermissions,
                'percent' => null, // Здесь процент не указан
            ],
        ];



        $compact = compact(
            'congregation',
            'metrics',
            'congregationRequests',
            'congregationRequestsCount',
        );

        $mobile_detect = new MobileDetect();

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = $mobile_detect->isMobile() ? 'Modules.congregation.overview' : 'Modules.congregation.overview';
            $view2 = 'BootstrapApp.Modules.congregations.overview';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function overviewAj($id)
    {

        $countUsers = User::where('congregation_id', $id)->count();
        $countGroups = Group::where('congregation_id', $id)->count();
        $countStands = Stand::where('congregation_id', $id)->count();
        $countCongregationsPermissions = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $id)
            ->count();


        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        $lastWeek = Carbon::now()->subWeek();
        $usersActiveCount = User::where(DB::raw('info->>"$.last_login"'), '>=', $lastWeek)->where('congregation_id', $id)->count();
        $usersCongregationCount = User::where('congregation_id', $id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->count();

        $usersActiveCount = !empty($usersActiveCount) ? $usersActiveCount : 0;
        $usersCongregationCount = !empty($usersCongregationCount) ? $usersCongregationCount : 0;

        // Проверка на ноль перед делением
        if ($usersCongregationCount !== 0) {
            $usersActiveCountPercent = ($usersActiveCount / $usersCongregationCount) * 100;
        } else {
            $usersActiveCountPercent = 0; // Если $usersCongregationCount равно нулю
        }


        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($id);
        $Developer = Role::where('slug', '=', 'Developer')->first();
        $Developers_id = UsersRoles::where('role_id', $Developer->id)->get();
        $permission_Overseers = Permission::where('name', 'like', 'Developer.User manager%')->get();

        $groups = Group::with('responsibleUserId')
            ->where('congregation_id', $id)
            ->get();

        foreach ($groups as $group) {
            $users_groups[] = UsersGroups::with('User')->where('group_id', $group->id)->get();
        }

        if($permission_Overseers->isEmpty()) {
            $permission_Overseer = '0';
        } else {
            foreach ($permission_Overseers as $permission_Oversee) {
                $permission_Overseer[] = UsersPermissions::with('User')
                    ->where('permission_id', $permission_Oversee->id)
                    ->get();
            }
        }

        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();
        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();

        $users = User::where('congregation_id', $id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        $connectedModules = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $id)
            ->get();

        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->count();

        $metrics = [
            [
                'title' => 'Количество возвещателей',
                'route' => route('congregation.publishers', $id),
                'count' => $usersCongregationCount,
                'percent' => null,
            ],
//            [
//                'title' => 'Активных за неделю',
//                'route' =>  route('congregation.ActiveUsersPerWeek', $id),
//                'count' => $usersActiveCount,
//                'percent' => $usersActiveCountPercent,
//            ],
            [
                'title' => 'Работающих стендов',
                'route' => route('congregation.stands', $id),
                'count' => $countStands,
                'percent' => null, // Здесь процент не указан
            ],
            [
                'title' => 'Подключено модулей',
                'route' => route('congregation.modules', $id),
                'count' => $countCongregationsPermissions,
                'percent' => null, // Здесь процент не указан
            ],
        ];



        $compact = compact(
            'congregation',
            'metrics',
            'congregationRequests',
            'congregationRequestsCount',
        );

        $mobile_detect = new MobileDetect();

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = $mobile_detect->isMobile() ? 'Modules.congregation.overview' : 'Modules.congregation.overview';
            $view2 =  'BootstrapApp.Modules.congregations.ajaxComponents.metrics';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }
    }


    public function groupView($congregation_id, $group_id) {

        $countUsers = User::where('congregation_id', $congregation_id)->count();
        $countGroups = Group::where('congregation_id', $congregation_id)->count();

        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        if ($usersRoleOverseers->isEmpty()) {
            $countOverseers = '0';
        } else {
            foreach ($usersRoleOverseers as $usersRoleOverseer) {
                $countOverseers[] = User::where('congregation_id', $congregation_id)
                    ->where('id', $usersRoleOverseers->user_id)
                    ->count();
            }
        }

        $congregation = Congregation::find($congregation_id);
        $Developer = Role::where('slug', '=', 'Developer')->first();
        $Developers_id = UsersRoles::where('role_id', $Developer->id)->get();
        $permission_Overseers = Permission::where('name', 'like', 'Developer.User manager%')->get();


        $group = Group::find($group_id);

        $users_groups = UsersGroups::with('User')->where('group_id', $group_id)->get();

        if($permission_Overseers->isEmpty()) {
            $permission_Overseer = '0';
        } else {
            foreach ($permission_Overseers as $permission_Oversee) {
                $permission_Overseer[] = UsersPermissions::with('User')
                    ->where('permission_id', $permission_Oversee->id)
                    ->get();
            }
        }

        $permission_stands = Permission::where('name','like', 'Stand%')->get();
        foreach ($users_groups as $user_group) {
            $users[] = User::with('personalReport.user')->where('id', $user_group->user_id)->get();
        }

        $AuthUser = User::find(Auth::id());


        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $mobile_detect = new MobileDetect();
        if ($AuthUser->hasRole('Developer')) {
            if ($mobile_detect->isMobile()) {
                return view('Mobile.congregation.group')
                ->with(['congregation' => $congregation])
                ->with(['congregationRequests' => $congregationRequests])
                ->with(['congregationRequestsCount' => $congregationRequestsCount])
                ->with(['users' => $users])
                ->with(['permission_stands' => $permission_stands])
                ->with(['permission_Overseer' => $permission_Overseer])
                ->with(['group' => $group])
                ->with(['countGroups' => $countGroups])
                ->with(['countOverseers' => $countOverseers])
                ->with(['countUsers' => $countUsers]);
            } else {
                return view('Desktop.congregation.group')
                    ->with(['congregation' => $congregation])
                    ->with(['congregationRequests' => $congregationRequests])
                    ->with(['congregationRequestsCount' => $congregationRequestsCount])
                    ->with(['users' => $users])
                    ->with(['permission_stands' => $permission_stands])
                    ->with(['permission_Overseer' => $permission_Overseer])
                    ->with(['group' => $group])
                    ->with(['countGroups' => $countGroups])
                    ->with(['countOverseers' => $countOverseers])
                    ->with(['countUsers' => $countUsers]);
            }
        } else {
            if($AuthUser->congregation_id == $congregation->id) {
                return view('congregation.group')
                    ->with(['congregation' => $congregation])
                    ->with(['congregationRequests' => $congregationRequests])
                    ->with(['congregationRequestsCount' => $congregationRequestsCount])
                    ->with(['users' => $users])
                    ->with(['permission_stands' => $permission_stands])
                    ->with(['permission_Overseer' => $permission_Overseer])
                    ->with(['group' => $group])
                    ->with(['countGroups' => $countGroups])
                    ->with(['countOverseers' => $countOverseers])
                    ->with(['countUsers' => $countUsers]);
            } else {
                return view('errors.423Locked');
            }
        }
    }

    public function viewExampleSchedule(){

        return view ('Mobile.menu.modules.meetingSchedules.overview');
    }


    public function connectModuleToCongregation(Request $request){

        $permission_id = $request->input('permission_id');
        $congregation_id = $request->input('congregation_id');


        $permissionModule = Permission::find($permission_id);
//        $congregation = Congregation::find($congregation);
        $usersCongregation = User::where('congregation_id', $congregation_id)->get();

//        $usersPermissionModule = UsersPermissions::
//        whereIn('user_id', User::where('congregation_id', '2')->pluck('id'))
//            ->where('permission_id', $permissionModule->id)->get();

        foreach($usersCongregation as $userCongregation) {
            $RolesPermissions = new UsersPermissions();
            $RolesPermissions->user_id = $userCongregation->id;
            $RolesPermissions->permission_id = $permission_id;

            // Проверяем, существует ли уже такая запись
            $existingPermission = UsersPermissions::where('user_id', $userCongregation->id)->where('permission_id', $permission_id)->first();

            if (!$existingPermission) {
                $RolesPermissions->save();
            }
        }

        $congregationPermission = new CongregationsPermissions();
        $congregationPermission->congregation_id = $congregation_id;
        $congregationPermission->permission_id = $permission_id;
        $congregationPermission->save();

        return redirect()->back()->with('success', 'Модуль Стенд успешно подключен к вашему собранию');
    }
    public function disconnectModuleToCongregation(Request $request){

        $permission_id = $request->input('permission_id');
        $congregation_id = $request->input('congregation_id');


        $permissionModule = Permission::find($permission_id);
//        $congregation = Congregation::find($congregation);
        $usersCongregation = User::where('congregation_id', $congregation_id)->get();

//        $usersPermissionModule = UsersPermissions::
//        whereIn('user_id', User::where('congregation_id', '2')->pluck('id'))
//            ->where('permission_id', $permissionModule->id)->get();


        foreach($usersCongregation as $userCongregation) {
            UsersPermissions::where('user_id', $userCongregation->id)
                ->where('permission_id', $permission_id)
                ->delete();
        }

        CongregationsPermissions::where('congregation_id', $congregation_id)->where('permission_id', $permission_id)->delete();;


        return redirect()->back()->with('success', 'Модуль отключен');
    }


    public function displayModules($congregation_id) {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($congregation_id);
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();

        $data = [
            'congregation' => [
                'id' => $congregation->id,
                'name' => $congregation->name,
            ],
            'permissions' => [],
        ];
        foreach ($permissions as $permission) {
            $has_permission = CongregationsPermissions::query()
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();

            $data['permissions'][] = [
                'id' => $permission->id,
                'name' => $permission->name,
                'has_permission' => $has_permission,
            ];
        }


        $compact = compact('data');

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = 'BootstrapApp.Modules.congregations.displays.modules';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }
    public function displayRequests($congregation_id) {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($congregation_id);
        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->get();
        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        $compact = compact(
            'congregation',
            'permissions',
            'congregationRequests',
            'congregationRequestsCount'
        );

        $mobile_detect = new MobileDetect();
        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view =  'Modules.congregation.displays.requests';
            return view($view, $compact);
        } else {
            return view('errors.423Locked');
        }
    }
    public function displayPublishers($congregation_id) {
        $congregation = Congregation::find($congregation_id);
        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $users = User::where('congregation_id', $congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();

        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        if(Auth::user()->hasRole('Developer')) {
            $permissions_users = Permission::get();
        } else{
            $permissions_users = Permission::where('name', 'LIKE', 'Stand%')->get();
        }

        $view1 = 'Modules.congregation.displays.publishers';
        $view2 = 'BootstrapApp.Modules.congregations.displays.publishers';

        return view($view2,compact(
            'congregation',
            'permissions_users',
            'users',
            'permissions','congregationRequestsCount'));
    }


    public function publishersAj($congregation_id) {
        $congregation = Congregation::find($congregation_id);
        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $users = User::where('congregation_id', $congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();

        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        if(Auth::user()->hasRole('Developer')) {
            $permissions_users = Permission::get();
        } else{
            $permissions_users = Permission::where('name', 'LIKE', 'Stand%')->get();
        }

        $view1 = 'Modules.congregation.displays.publishers';
        $view2 = 'BootstrapApp.Modules.congregations.ajaxComponents.publishers';

        return view($view2,compact(
            'congregation',
            'permissions_users',
            'users',
            'permissions','congregationRequestsCount'));
    }

    public function createUserAj($congregation_id){
        $congregation = Congregation::query()->find($congregation_id);
        $compact = compact('congregation');
        return view('BootstrapApp.Modules.congregations.ajaxComponents.createUser', $compact);
    }

    public function settingsAj($congregation_id){

        $congregation = Congregation::query()->find($congregation_id);

        $compact = compact('congregation');
        return view('BootstrapApp.Modules.congregations.ajaxComponents.settings', $compact);
    }

    public function meetingTime(Request $request, $congregation_id){

        // Валидация данных, если необходимо
//        $request->validate([
//            'weekday' => 'required|string',
//            'weekdayTime' => 'required|date_format:H:i',
//            'weekend' => 'required|string',
//            'weekendTime' => 'required|date_format:H:i',
//        ]);

        $congregation = Congregation::query()->find($congregation_id);

        $infoData = [
            'weekday' => $request->input('weekday'),
            'weekdayTime' => $request->input('weekdayTime'),
            'weekend' => $request->input('weekend'),
            'weekendTime' => $request->input('weekendTime'),
        ];

        $congregation->info = json_encode($infoData);
        $congregation->save();

        $compact = compact('congregation');
        return $this->settings($congregation);
    }








    public function createUserFromCongregation(Request $request, $id)
    {
        $data = $request->all();

        Log::info('Request data received:', ['data' => $data]);

        $messages = [
            'first_name.required' => 'Пожалуйста, введите имя.',
            'last_name.required'  => 'Пожалуйста, укажите фамилию.',
            'email.required' => 'Email уже существует или не имеет формат почты @mail.com!',
            'email.email' => 'Пожалуйста, укажите правильный формат почты "@mail.com"!',
            'email.unique' => 'Введенный email уже используется, пожалуйста введите другой.',
            'login.unique' => 'Такой логин уже существует, укажите логин не существующий в системе',
            'login.required' => 'Необходимо указать логин',
            'password.required' => 'Пожалуйста, укажите пароль не меньше 6 символов',
            'mobile_phone.numeric' => 'Пожалуйста, напишите номер только цифрами.'
        ];

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'mobile_phone' => ['nullable','numeric','min:8'],
        ], $messages);

        Log::info('Data after validation:', ['validated_data' => $validated]);

//        if ($validated->fails())
//        {
//            return response()->json(['errors'=>$validated->errors()]);
//        }

        $new_user = new User;
        $new_user->first_name = $validated['first_name'];
        $new_user->last_name = $validated['last_name'];
        $new_user->email = $validated['email'];
        $new_user->login = $validated['login'];
        $new_user->password = Hash::make($validated['password']);
        $new_user->congregation_id = $id;
        $new_user->info = json_encode(['registration_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'account_type' => 'personal',
            'mobile_phone' => $validated['mobile_phone']]);
        $new_user->save();

        Log::info('New user:', ['new_user' => $new_user]);

        Astart::create([
            'user_id' => $new_user->id,
            'password' => $validated['password'],
        ]);

        return $this->view($id);
    }


    public function switchPermission(Request $request) {
        $userId = $request->input('user_id');
        $permissionId = $request->input('permission_id');
        $isChecked = $request->input('is_checked');


        $existingPermission = UsersPermissions::where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->first();

//        if ($isChecked && !$existingPermission) {
//            DB::table('users_permissions')::insert([
//                'user_id' => $userId,
//                'permission_id' => $permissionId,
//            ]);
//        } elseif (!$isChecked && $existingPermission) {
//            $existingPermission->delete();
//        }
    }

    public function displayAppointed($congregation_id) {
        $congregation = Congregation::find($congregation_id);

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $users = User::where('congregation_id', $congregation_id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        return view('Mobile.menu.modules.congregation.display.appointed',compact(
            'congregation',
            'users',
            'permissions','congregationRequestsCount'));
    }
    public function displaySettings($congregation_id) {
        $congregation = Congregation::find($congregation_id);
        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $users = User::where('congregation_id', $congregation_id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        return view('Mobile.menu.modules.congregation.display.settings',compact(
            'congregation',
            'users',
            'permissions','congregationRequestsCount'));
    }

    public function displayActiveUsersPerWeek($congregation_id) {

        $lastWeekTimestamp = now()->subWeek();
        $users = User::whereRaw('JSON_EXTRACT(info, "$.last_login") IS NOT NULL')
            ->where('congregation_id', $congregation_id)
            ->where(DB::raw('info->>"$.last_login"'), '>=', $lastWeekTimestamp)
            ->orderByDesc('info->last_login')
            ->get();

        $congregation = Congregation::query()->find($congregation_id);
        $compact = compact('users',
            'congregation');
        return view('Modules.congregation.displays.ActiveUsersPerWeek', $compact);
    }

    public function displayStands($congregation_id) {

        $user = User::find(Auth::id());
        $congregation = Congregation::find($congregation_id);

        if($user->hasRole('Developer')) {
            $accessible_stands_for_the_user = Stand::where('congregation_id', $congregation_id)->get();
        } else {
            $accessible_stands_for_the_user = DB::table('users')
                ->join('stands', 'stands.congregation_id', '=', 'users.congregation_id')
                ->select('stands.*')
                ->where('users.id', Auth::id())
                ->where('stands.congregation_id', $congregation_id)
                ->get();
        }


        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $congregation_id)
            ->count();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();

        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }
        $compact = compact(
            'congregation',
            'accessible_stands_for_the_user',
            'permissions',
            'congregationRequestsCount'
        );

        return view('Modules.congregation.displays.stands', $compact);
    }

    public function infoSave($congregation_id) {

        $array = [
            'meeting_on_weekday',
            'meeting_on_weekend',
            'adress',
            'city',
            'district',
            'country',
            'telephone',
        ];
    }

    public function allow($id, $user_id) {

        $user = User::find($user_id);
        $user->congregation_id = $id;
        $user->save();


        $congregationModules = CongregationsPermissions::where('congregation_id', $id)->get();

        foreach ($congregationModules as $congregationModule) {
            $userPermissions = new UsersPermissions();
            $userPermissions->user_id = $user_id;
            $userPermissions->permission_id = $congregationModule->permission_id;
            $userPermissions->save();
        }

        $congrRequests = CongregationRequests::where('user_id', $user_id);
        $congrRequests->delete();

        return redirect()->route('congregationView', $id);
    }

    public function updateProfile(Request $request, $id)
    {
        // Валидация данных
        $request->validate([
            'editFirstNameModal' => 'required|string|max:255',
            'editLastNameModal' => 'required|string|max:255',
            'userIdInput' => 'required',
            'typePhone' => 'string|max:17',
        ]);

        $user = User::find($request->input('userIdInput'));
        $user_info = json_decode($user->info, true);

        if (isset($user_info['mobile_phone'])) {
            $user_info['mobile_phone'] = $request->input('typePhone');
        } else {
            $user_info['mobile_phone'] = $request->input('typePhone');
        }

        $user->update([
            'first_name' => $request->input('editFirstNameModal'),
            'last_name' => $request->input('editLastNameModal'),
            'info' => json_encode($user_info),
        ]);

        return redirect()->back();
    }

    public function deleteProfile(Request $request, $id)
    {
        $request->validate([
            'userIdInputDelete' => 'required',
        ]);

        $user = User::find($request->input('userIdInputDelete'));

        $user_info = json_decode($user->info, true);

        if (isset($user_info['account_type'])) {
            $user_info['account_type'] = 'deleted';
        } else {
            $user_info['account_type'] = 'deleted';
        }
        $user->update([
            'info' => json_encode($user_info),
        ]);

        UsersPermissions::where('user_id', $request->input('userIdInputDelete'))->delete();


        return redirect()->back();
    }







    public function reject($id, $conReq) {

        $congrRequests = CongregationRequests::find($conReq);
        $congrRequests->delete();

        return redirect()->route('congregationView', $id);
    }

    public function index(): JsonResource
    {
        $congregations = Congregation::query()->select('id', 'name')->get();

        return JsonResource::collection($congregations);
    }

    public function store(Request $request): JsonResource {
        $congregation = Congregation::query()->create([
            'name' => $request->post('name'),
        ]);

        return new JsonResource($congregation);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $congregation = Congregation::query()->findOrFail($id);

        $congregation->update([
            'name' => $request->post('name'),
        ]);

        return new JsonResource($congregation);
    }

    public function destroy(int $id): JsonResponse
    {
        Congregation::destroy($id);

        return Response::json(['message' => 'Congregation was deleted.']);
    }
}
