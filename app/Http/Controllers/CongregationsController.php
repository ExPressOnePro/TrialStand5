<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\CongregationsPermissions;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersGroups;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Detection\MobileDetect;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CongregationsController extends Controller {

    public function select() {
        $congregation = Congregation::where('id', '>', 1)->get();

        $mobile_detect = new MobileDetect();
        if ($mobile_detect->isMobile()) {
            return view('Mobile.menu.modules.select')
                ->with(['congregation' => $congregation,]);
        } else {
            return view('Desktop.congregation.select')
                ->with(['congregation' => $congregation,]);
        }
    }

    public function view($id) {

        // Coutns
        $countUsers = User::where('congregation_id', $id)->count();
        $countGroups = Group::where('congregation_id', $id)->count();

        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        if ($usersRoleOverseers->isEmpty()) {
            $countOverseers = '0';
        } else {
            foreach ($usersRoleOverseers as $usersRoleOverseer) {
                $countOverseers[] = User::where('congregation_id', $id)
                    ->where('id', $usersRoleOverseers->user_id)
                    ->count();
            }
        }

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

        $AuthUser = User::find(Auth::id());

        $congregationModules = CongregationsPermissions::where('congregation_id', $id)->get();
        $permissions = Permission::where('name', 'LIKE', 'module%')->get();


        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->count();

        $mobile_detect = new MobileDetect();

        if ($AuthUser->hasRole('Developer') || ($AuthUser->congregation_id == $congregation->id)) {
            $view = $mobile_detect->isMobile() ? 'Mobile.menu.modules.congregation.main' : 'Desktop.congregation.main';

            return view($view, compact(
                'congregation',
                'congregationRequests',
                'congregationRequestsCount',
                'users',
                'permission_stands',
                'permission_Overseer',
                'groups',
                'countGroups',
                'countOverseers',
                'countUsers',
                'congregationModules',
                'permissions'

            ));
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

        return view ('Mobile.modules.examples.meetingSchedule');
    }

    public function connectModuleStand(){

        $roleDeveloper = Role::where('name', 'Developer')->first();
        $permissionModule = Permission::where('name', 'module.stand')->first();
        $congregation = '2';
        $usersCongregation = User::where('congregation_id', $congregation)->get();

        $usersPermissionModule = UsersPermissions::
        whereIn('user_id', User::where('congregation_id', '2')->pluck('id'))
            ->where('permission_id', $permissionModule->id)->get();


        foreach($usersCongregation as $userCongregation) {
            $RolesPermissions = new UsersPermissions();
            $RolesPermissions->user_id = $userCongregation->id;
            $RolesPermissions->permission_id = $permissionModule->id;
            $RolesPermissions->save();
        }

        $congregationPermission = new CongregationsPermissions();
        $congregationPermission->congregation_id = $congregation;
        $congregationPermission->permission_id = $permissionModule->id;
        $congregationPermission->save();

        return redirect()->back()->with('success', 'Модуль Стенд успешно подключен к вашему собранию');
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


        $rolePublisher = Role::where('name', 'Publisher')->first();
        $roleGuest = Role::where('name', 'Guest')->first();

        $UserRole = UsersRoles::where('user_id', $user_id)->where('role_id',$roleGuest)->update([
            'user_id' => $user_id,
            'role_id' => $rolePublisher->id
        ]);


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
