<?php

namespace App\Http\Controllers\Congregation;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Response;

class CongregationsController extends Controller {

    public function hub() {
        $AuthUser = User::find(Auth::id());
        $congregation = Congregation::where('id', '>', 1)->get();

        $compact = compact('congregation');
        if($AuthUser->hasRole('Developer')){
            $view = 'Mobile.menu.modules.congregation.hub';
            return view($view, $compact);
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
        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        $lastWeek = Carbon::now()->subWeek();
        $usersActiveCount = User::where(DB::raw('info->>"$.last_login"'), '>=', $lastWeek)->where('congregation_id', $id)->count();
        $usersCongregationCount = User::where('congregation_id', $id)->count();

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

        $users = User::where('congregation_id', $id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation->id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->count();


        $compact = compact(
            'congregation',
            'congregationRequests',
            'congregationRequestsCount',
            'usersCongregationCount',
            'usersActiveCount',
            'usersActiveCountPercent',
            'users',
            'permission_stands',
            'permission_Overseer',
            'groups',
            'countGroups',
            'countOverseers',
            'countUsers',
            'congregationModules',
            'permissions'
        );

        $mobile_detect = new MobileDetect();

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = $mobile_detect->isMobile() ? 'Mobile.menu.modules.congregation.main' : 'Mobile.menu.modules.congregation.main';
            return view($view, $compact);
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
            'congregationRequestsCount'
        );
        $mobile_detect = new MobileDetect();
        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = $mobile_detect->isMobile() ? 'Mobile.menu.modules.congregation.display.modules' : 'Mobile.menu.modules.congregation.display.modules';
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
            $view = $mobile_detect->isMobile() ? 'Mobile.menu.modules.congregation.display.requests' : 'Mobile.menu.modules.congregation.display.requests';
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

        $users = User::where('congregation_id', $congregation_id)->get();

        $congregationModules = CongregationsPermissions::where('congregation_id', $congregation_id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();
        foreach ($permissions as $permission) {
            $permission->has_permission = DB::table('congregations_permissions')
                ->where('congregation_id', $congregation_id)
                ->where('permission_id', $permission->id)
                ->exists();
        }

        return view('Mobile.menu.modules.congregation.display.publishers',compact(
            'congregation',
            'users',
            'permissions','congregationRequestsCount'));
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

        return view('Mobile.menu.modules.congregation.display.stands', $compact);
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
