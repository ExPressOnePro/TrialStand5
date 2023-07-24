<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\CongregationRequests;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersGroups;
use App\Models\UsersPermissions;
use App\Models\UsersRoles;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CongregationsController extends Controller {

    public function select() {
        $congregation = Congregation::where('id', '>', 1)->get();

        return view('congregation.select')->with([
            'congregation' => $congregation,
        ]);
    }

    public function view($id) {

        // Coutns
        $countUsers = User::where('congregation_id', $id)->count();
        $countGroups = Group::where('congregation_id', $id)->count();

        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        if ($usersRoleOverseers->isEmpty()) {
            $countOverseers = '0';
        }
        else {
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
        }
        else {
            foreach ($permission_Overseers as $permission_Oversee) {
                $permission_Overseer[] = UsersPermissions::with('User')
                    ->where('permission_id', $permission_Oversee->id)
                    ->get();
            }
        }

        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();
        $users = User::where('congregation_id', $id)->get();
        $AuthUser = User::find(Auth::id());


        $congregationRequests = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->get();

        $congregationRequestsCount = CongregationRequests::with('user')
            ->where('congregation_id', $id)
            ->count();

        if ($AuthUser->hasRole('Developer')){
            return view('congregation.main')
                ->with(['congregation' => $congregation])
                ->with(['congregationRequests' => $congregationRequests])
                ->with(['congregationRequestsCount' => $congregationRequestsCount])
                ->with(['users' => $users])
                ->with(['permission_stands' => $permission_stands])
                ->with(['permission_Overseer' => $permission_Overseer])
                ->with(['groups' => $groups])
                ->with(['users_groups' => $users_groups])
                ->with(['countGroups' => $countGroups])
                ->with(['countOverseers' => $countOverseers])
                ->with(['countUsers' => $countUsers]);
        }
        else{
            if($AuthUser->congregation_id == $congregation->id) {
                return view('congregation.main')
                    ->with(['congregation' => $congregation])
                    ->with(['congregationRequests' => $congregationRequests])
                    ->with(['users' => $users])
                    ->with(['permission_stands' => $permission_stands])
                    ->with(['countUsers' => $countUsers]);
            }
            else{
                return view('errors.423Locked');
            }
        }
    }

    public function groupView($congregation_id, $group_id) {

        // Coutns
        $countUsers = User::where('congregation_id', $congregation_id)->count();
        $countGroups = Group::where('congregation_id', $congregation_id)->count();

        $usersRoleOverseers = UsersRoles::where('role_id', 'Overseer')->get();

        if ($usersRoleOverseers->isEmpty()) {
            $countOverseers = '0';
        }
        else {
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

        /*foreach ($groups as $group) {
            $users_groups[] = UsersGroups::with('User')->where('group_id', $group->id)->get();
        }*/
        $users_groups = UsersGroups::with('User')->where('group_id', $group_id)->get();

        if($permission_Overseers->isEmpty()) {
            $permission_Overseer = '0';
        }
        else {
            foreach ($permission_Overseers as $permission_Oversee) {
                $permission_Overseer[] = UsersPermissions::with('User')
                    ->where('permission_id', $permission_Oversee->id)
                    ->get();
            }
        }

        $permission_stands = Permission::where('name','like', 'User. Stand%')->get();
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

        if ($AuthUser->hasRole('Developer')){
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
        }
        else{
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
            }
            else{
                return view('errors.423Locked');
            }
        }
    }
    public function allow($id, $user_id) {

       /* Gate::define('menage-users', function ($id, $user_id) {*/
            $user = User::find($user_id);
            $user->congregation_id = $id;
            $user->save();

            $roleUserID = Role::where('name', 'Publisher')->first();

            $UsersRoles = new UsersRoles();
            $UsersRoles->user_id = $user_id;
            $UsersRoles->role_id = $roleUserID->id;
            $UsersRoles->save();

            $congrRequests = CongregationRequests::where('user_id', $user_id);
            $congrRequests->delete();

            return redirect()->route('congregationView', $id);
        /*});*/


        /*$user = User::find($user_id);
        $user->congregation_id = $id;
        $user->save();

        $roleUserID = Role::where('name', 'User')->first();

        $UsersRoles = new UsersRoles();
        $UsersRoles->user_id = $user_id;
        $UsersRoles->role_id = $roleUserID->id;
        $UsersRoles->save();

        $congrRequests = CongregationRequests::where('user_id', $user_id);
        $congrRequests->delete();

        return redirect()->route('congregationView', $id);*/
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
