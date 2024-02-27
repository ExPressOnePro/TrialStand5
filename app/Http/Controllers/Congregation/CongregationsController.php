<?php

namespace App\Http\Controllers\Congregation;

use App\Http\Controllers\Controller;
use App\Models\Astart;
use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\CongregationsPermissions;
use App\Models\Group;
use App\Models\MeetingScheduleTemplate;
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

        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($id);


        $compact = compact(
            'congregation',
        );

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view2 = 'BootstrapApp.Modules.congregations.overview';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function overviewAj($id)
    {
        $countStands = Stand::where('congregation_id', $id)->count();
        $countCongregationsPermissions = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $id)
            ->count();

        $lastWeek = Carbon::now()->subWeek();
        $usersCongregationCount = User::where('congregation_id', $id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->count();
        $usersCongregationCount = !empty($usersCongregationCount) ? $usersCongregationCount : 0;

        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($id);
        $Developer = Role::where('slug', '=', 'Developer')->first();

        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $id)
                ->where('permission_id', $permission->id)
                ->exists();
        }
        $metrics = [
            [
                'title' => 'Возвещатели',
                'route' => '',
                'count' => $usersCongregationCount,
            ],
            [
                'title' => 'Стенды',
                'route' => '',
                'count' => $countStands,
            ],
            [
                'title' => 'Модули',
                'route' => '',
                'count' => $countCongregationsPermissions,
            ],
        ];

        $congregationInfo = json_decode($congregation->info, true);

        if($congregationInfo === null) {
            $congregation_info = null;
        } else  {
            $weekday = $congregationInfo['weekday'];
            $weekend = $congregationInfo['weekend'];
            $day_weekday = Carbon::now()->startOfWeek()->addDays($weekday - 1)->isoFormat('dddd');
            $day_weekend = Carbon::now()->startOfWeek()->addDays($weekend - 1)->isoFormat('dddd');
            $congregation_info = $day_weekday .' '.$congregationInfo['weekdayTime'].', '. $day_weekend .' '.$congregationInfo['weekendTime'];

        }

        $compact = compact(
            'congregation',
            'metrics',
            'congregation_info',
        );

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view2 =  'BootstrapApp.Modules.congregations.ajaxComponents.metrics';
            return view($view2, $compact);
        } else {
            return view('errors.423Locked');
        }
    }

    public function saveDateTimeForMeetings(Request $request, $id)
    {

        $congregation = Congregation::find($id);
        if ($congregation) {

            $congregation_info_decode = json_decode($congregation->info, true);

            $congregation_info_decode['weekdayTime'] = $request->input('weekdayTime');
            $congregation_info_decode['weekendTime'] = $request->input('weekendTime');
            $congregation_info_decode['weekday'] = $request->input('weekday');
            $congregation_info_decode['weekend'] = $request->input('weekend');

            $updated_info = json_encode($congregation_info_decode);

            $congregation->info = $updated_info;
            $congregation->save();

            return redirect()->back()->with('success', 'Информация о днях и времени встреч успешно сохранена');
        } else {
            return redirect()->back()->with('error', 'Собрание не найдено');
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

    public function standsAj($congregation_id){

        $congregation = Congregation::query()->find($congregation_id);
        $user = User::find(Auth::id());

        $accessible_stands_for_the_user = User::findOrFail(Auth::id())
            ->stands()
            ->where('congregation_id', $congregation->id)
            ->get();

        $compact = compact(
            'accessible_stands_for_the_user',
            'congregation',
        );

        return view('BootstrapApp.Modules.congregations.ajaxComponents.stands', $compact);
    }

    public function getContent($content)
    {
        $user = User::find(Auth::id());
        $congregation_id = $user->congregation_id;

        switch ($content) {
            case 'over':
                $html = $this->over($congregation_id);
                return response()->json(['content' => $html]);
                break;
            case 'publishers':
                $html = $this->getAllPublishers($congregation_id);
                return response()->json(['content' => $html]);
                break;
            case 'modules':
                $html = $this->getAllModules($congregation_id);
                return response()->json(['content' => $html]);
                break;
            case 'stands':
                $html = $this->getAllStands($congregation_id);
                return response()->json(['content' => $html]);
                break;
            case 'personalInfo':
                $html = $this->getPersonalInfo($congregation_id);
                return response()->json(['content' => $html]);
                break;
        }
        return response()->json(['content' => $content]);
    }

    public function getCont($content, $userId)
    {
        // Fetch the user based on the user_id
        $user = User::find($userId);

        // Handle if the user is not found
        if (!$user) {
            return response()->json(['error' => 'User not found']);
        }

        // Fetch other required data
        $congregation_id = $user->congregation_id;
        $congregation = Congregation::find($congregation_id);
        $userInfo = json_decode($user->info, true);

        // Prepare the compact array and return the view
        $compact = compact('user', 'userInfo', 'congregation');
        $html = view('BootstrapApp.Modules.congregations.ajaxComponents.publisherSettings', $compact)->render();

        return response()->json(['content' => $html]);
    }

    private function over($congregation_id)
    {
        $countStands = Stand::where('congregation_id', $congregation_id)->count();
        $countCongregationsPermissions = CongregationsPermissions::with('permission')
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', 'module%');
            })
            ->where('congregation_id', $congregation_id)
            ->count();

        $usersCongregationCount = User::where('congregation_id', $congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->count();
        $usersCongregationCount = !empty($usersCongregationCount) ? $usersCongregationCount : 0;

        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::find($congregation_id);

        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }
        $metrics = [
            [
                'title' => 'Возвещатели',
                'count' => $usersCongregationCount,
            ],
            [
                'title' => 'Стенды',
                'count' => $countStands,
            ],
            [
                'title' => 'Модули',
                'count' => $countCongregationsPermissions,
            ],
        ];

        $congregationInfo = json_decode($congregation->info, true);

        if($congregationInfo === null) {
            $congregation_info = null;
        } else  {
            $weekday = $congregationInfo['weekday'];
            $weekend = $congregationInfo['weekend'];
            $day_weekday = Carbon::now()->startOfWeek()->addDays($weekday - 1)->isoFormat('dddd');
            $day_weekend = Carbon::now()->startOfWeek()->addDays($weekend - 1)->isoFormat('dddd');
            $congregation_info = $day_weekday .' '.$congregationInfo['weekdayTime'].', '. $day_weekend .' '.$congregationInfo['weekendTime'];

        }

        $compact = compact(
            'congregation',
            'metrics',
            'congregation_info',
        );


        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view2 =  'BootstrapApp.Modules.congregations.ajaxComponents.metrics';
            return view($view2, $compact)->render();
        } else {
            return view('errors.423Locked');
        }
    }

    private function getAllPublishers($congregation_id)
    {
        $congregation = Congregation::find($congregation_id);

        $users = User::where('congregation_id', $congregation_id)
            ->where(function ($query) {
                $query->whereRaw("JSON_EXTRACT(info, '$.account_type') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(info, '$.account_type') != 'deleted'");
            })
            ->get();

        return view('BootstrapApp.Modules.congregations.ajaxComponents.publishers', compact('congregation', 'users'))->render();
    }

    private function getAllModules($congregation_id)
    {
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
            $view = 'BootstrapApp.Modules.congregations.ajaxComponents.modules';
            return view($view, $compact)->render();
        } else {
            return view('errors.423Locked');
        }
    }

    private function getAllStands($congregation_id)
    {

        $congregation = Congregation::query()->find($congregation_id);
        $user = User::find(Auth::id());

        $accessible_stands_for_the_user = User::findOrFail(Auth::id())
            ->stands()
            ->where('congregation_id', $congregation->id)
            ->get();

        $compact = compact(
            'accessible_stands_for_the_user',
            'congregation',
        );

        return view('BootstrapApp.Modules.congregations.ajaxComponents.stands', $compact)->render();
    }

    private function getPersonalInfo($congregation_id)
    {
        $congregation = Congregation::find($congregation_id);
//        $user = User::find($user_id);
//
//        if (!$user) {
//            return redirect()->back()->with('error', 'User not found');
//        }
//
//        $userInfo = json_decode($user->info, true);
//        $compact = compact('user', 'userInfo', 'congregation');

        return view('BootstrapApp.Modules.congregations.ajaxComponents.publisherSettings')->render();
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
